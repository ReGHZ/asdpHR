<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PengajuanCuti;
use App\Models\User;
use App\Notifications\NotifCuti;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

class PengajuanCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get user
        $user = Auth::user();

        //get all data cuti
        $dataCuti = PengajuanCuti::with('usercuti')->get();

        return view('cuti.index', compact('user', 'dataCuti'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validator
        $request->validate([
            'tanggal_mulai'                      => 'required',
            'jenis_cuti'                         => 'required',
            'lama_hari'                          => 'required|numeric|min:1|max:30',
            'keterangan'                         => 'required',

        ], [
            'tanggal_mulai.required'             => 'Tanggal mulai harus diisi',
            'jenis_cuti.required'                => 'Jenis cuti harus diisi',
            'lama_hari.required'                 => 'Hari harus diisi',
            'keterangan.required'                => 'Keterangan harus diisi',
        ]);

        //generate nomor surat thats reset every year
        $nomorSurat = PengajuanCuti::whereYear("created_at", Carbon::now()->year)->count();

        //generate tanggal surat now
        $tanggal_surat = Carbon::now();

        //get auth user
        $pegawai = Auth::user();

        // Condition if user select cuti tahunan
        // return json_encode($request->jenis_cuti);
        if ($request->jenis_cuti == 'Cuti tahunan') {
            $cuti = Pegawai::where('id', $pegawai->id)->where('kuota_cuti', '>=', $request->lama_hari)->first();
            // return json_encode($kuota_cuti);
            if ($cuti) {
                $cuti->kuota_cuti = $cuti->kuota_cuti - $request->lama_hari;
                $cuti->update();
                // return redirect()->back()->with('success', 'Pengajuan cuti berhasil');
            } else {
                return redirect()->back()->with('error', 'Cuti ditolak, dikarenakan melebihi Kuota cuti tahun ini');
            }
        }

        //create new pengajuan cuti
        $cuti = PengajuanCuti::create([
            'usercuti_id'           => $pegawai->id,
            'nomor_surat'           => $nomorSurat,
            'tanggal_mulai'         => $request->tanggal_mulai,
            'jenis_cuti'            => $request->jenis_cuti,
            'lama_hari'             => $request->lama_hari,
            'tanggal_surat'         =>  $tanggal_surat,
            'keterangan'            => $request->keterangan,
            'status'                => 'Pending',
        ]);

        $cuti->save();

        //get data user that have role admin & manajer
        $user = User::with('roles')->whereIn('id', [1, 3])->get();
        // return dd($user);

        //send notification to admin
        Notification::send($user, new NotifCuti($cuti));
        // User::where('id')->firstOrFail()->notify($user, new NotifCuti($kuota_cuti));

        return redirect()->back()->with('success', 'Pengajuan cuti berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

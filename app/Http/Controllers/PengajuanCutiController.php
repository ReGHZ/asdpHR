<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Divisi;
use App\Models\Pegawai;
use App\Models\PengajuanCuti;
use App\Models\User;
use App\Notifications\NotifCuti;
use App\Notifications\NotifTerimaCuti;
use App\Notifications\NotifTolakCuti;
use Carbon\Carbon;
use DateTime;
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
        $dataCuti = PengajuanCuti::with('user')->get();

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
            'tanggal_selesai'                    => 'required',
            'jenis_cuti'                         => 'required',
            'keterangan'                         => 'required',

        ], [
            'tanggal_mulai.required'             => 'Tanggal mulai harus diisi',
            'tanggal_selesai.required'           => 'Tanggal selesai harus diisi',
            'jenis_cuti.required'                => 'Jenis cuti harus diisi',
            'keterangan.required'                => 'Keterangan harus diisi',
        ]);

        //generate nomor surat thats reset every year
        $nomorSurat = PengajuanCuti::whereYear("created_at", Carbon::now()->year)->count();

        //generate tanggal surat now
        $tanggal_surat = Carbon::now();

        //get auth user
        $pegawai = Auth::user();

        //get lama hari
        $tanggal_mulai = $request->tanggal_mulai;
        $tanggal_selesai = $request->tanggal_selesai;
        $datetime1 = new DateTime($tanggal_mulai);
        $datetime2 = new DateTime($tanggal_selesai);
        $interval = $datetime1->diff($datetime2);
        $lama_hari = $interval->format('%a');

        // Condition if user select cuti tahunan
        // return json_encode($request->jenis_cuti);
        if ($request->jenis_cuti == 'Cuti tahunan') {
            $cuti = Pegawai::where('id', $pegawai->id)->where('kuota_cuti', '>=', $lama_hari)->first();
            // return json_encode($cuti);
            if ($cuti) {
                $cuti->kuota_cuti = $cuti->kuota_cuti - $lama_hari;
                $cuti->update();
                // return redirect()->back()->with('success', 'Pengajuan cuti berhasil');
            } else {
                return redirect()->back()->with('error', 'Cuti ditolak, dikarenakan melebihi Kuota cuti tahun ini');
            }
        }

        //create new pengajuan cuti
        $cuti = PengajuanCuti::create([
            'user_id'               => $pegawai->id,
            'nomor_surat'           => $nomorSurat,
            'tanggal_mulai'         => $request->tanggal_mulai,
            'tanggal_selesai'       => $request->tanggal_selesai,
            'jenis_cuti'            => $request->jenis_cuti,
            'lama_hari'             => $lama_hari,
            'tanggal_surat'         => $tanggal_surat,
            'keterangan'            => $request->keterangan,
            'status'                => 'menunggu konfirmasi',
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
    public function markNotif($id)
    {
        if ($id) {

            auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
        }

        return redirect('/pengajuan-cuti');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function markAll()
    {

        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cuti = PengajuanCuti::with('user.pegawai')->find($id);
        return view('cuti.suratCuti', compact('cuti'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateReject(PengajuanCuti $pengajuan)
    {

        $pengajuan->status = 'ditolak';
        $pengajuan->update();

        //get data user that have role user
        $user = User::where('id', $pengajuan->user_id)->get();
        //send notification to user
        Notification::send($user, new NotifTolakCuti($pengajuan));

        return redirect('/pengajuan-cuti')->with('success', 'Pengajuan cuti ditolak');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateApprove(PengajuanCuti $pengajuan)
    {
        //generate nomor surat thats reset every year
        $nomorSurat = PengajuanCuti::whereYear("created_at", Carbon::now()->year)->count();

        $pengajuan->status = 'disetujui';
        $pengajuan->update();
        $pengajuan->persetujuanCuti()->create([
            'pengajuan_cuti_id' => $pengajuan->id,
            'user_id' => $pengajuan->user_id,
            'nomor_surat' => $nomorSurat,
            'tanggal_surat' => $pengajuan->tanggal_surat,
            'keterangan' => $pengajuan->keterangan,
        ]);

        $user = User::where('id', $pengajuan->user_id)->get();
        //send notification to user
        Notification::send($user, new NotifTerimaCuti($pengajuan));

        return redirect('/pengajuan-cuti')->with('success', 'Pengajuan cuti disetujui');
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

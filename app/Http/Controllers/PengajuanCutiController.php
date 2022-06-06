<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PengajuanCuti;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $user = Auth::user();

        return view('cuti.index', compact('user'));
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

        $nomorSurat = PengajuanCuti::whereYear("created_at", Carbon::now()->year)->count();
        $tanggal_surat = Carbon::now();

        $pegawai = Auth::user();
        // return json_encode($request->jenis_cuti);
        if ($request->jenis_cuti == 'Cuti tahunan') {
            $kuota_cuti = Pegawai::where('id', $pegawai->id)->where('kuota_cuti', '>=', $request->lama_hari)->first();
            // return json_encode($kuota_cuti);
            if ($kuota_cuti) {
                $kuota_cuti->kuota_cuti = $kuota_cuti->kuota_cuti - $request->lama_hari;
                $kuota_cuti->update();
                // return redirect()->back()->with('success', 'Pengajuan cuti berhasil');
            } else {
                return redirect()->back()->with('error', 'Cuti ditolak, dikarenakan melebihi Kuota cuti tahun ini');
            }
        }

        $kuota_cuti = PengajuanCuti::create([
            'usercuti_id'           => $pegawai->id,
            'nomor_surat'           => $nomorSurat,
            'tanggal_mulai'         => $request->tanggal_mulai,
            'jenis_cuti'            => $request->jenis_cuti,
            'lama_hari'             => $request->lama_hari,
            'tanggal_surat'         =>  $tanggal_surat,
            'keterangan'            => $request->keterangan,
            'status'                => 'Pending',
        ]);

        $kuota_cuti->save();

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

<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\PerjalananDinas;
use App\Models\User;
use App\Notifications\NotifPenugasanDinas;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PerjalananDinasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get data penugasan with pegawai and pengikut
        $penugasan = PerjalananDinas::with('user', 'pengikut')->get();
        $pegawai = User::all();
        $divisi = Divisi::all();
        return view('perjalanandinas.index', compact('penugasan', 'pegawai', 'divisi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'user_id'                       => 'required',
            'perihal'                       => 'required',
            'pembebanan_biaya'              => 'required',
            'tanggal_keberangkatan'         => 'required|date',
            'tanggal_kembali'               => 'required|date|after:tanggal_keberangkatan',
            'jenis_kendaraan'               => 'required',
            'tujuan'                        => 'required',
        ], [
            'user_id.required'              => 'pegawai cuti harus diisi',
            'perihal.required'              => 'Perihal harus diisi',
            'pembebanan_biaya.required'     => 'Pembebanan Biaya harus diisi',
            'tanggal_keberangkatan.required' => 'Tanggal Keberangkatan harus diisi',
            'tanggal_kembali.required'      => 'Tanggal kembali harus sebelum tanggal mulai',
            'jenis_kendaraan.required'      => 'Jenis kendaraan harus diisi',
            'tujuan.required'               => 'Tujuan harus diisi',
        ]);

        //generate nomor surat thats reset every year
        $nomorSurat = PerjalananDinas::whereYear("created_at", Carbon::now()->year)->count();

        //generate tanggal surat now
        $tanggal_surat = Carbon::now();

        //get lama hari
        $tanggal_keberangkatan = $request->tanggal_keberangkatan;
        $tanggal_kembali = $request->tanggal_kembali;
        $datetime1 = new DateTime($tanggal_keberangkatan);
        $datetime2 = new DateTime($tanggal_kembali);
        $interval = $datetime1->diff($datetime2);
        $lama_hari = $interval->format('%a');

        //if pengikut == null create new penugasan
        if ($request->pengikut == null) {
            $penugasan = PerjalananDinas::create([
                'user_id' => $request->user_id,
                'nomor_surat' => $nomorSurat,
                'tanggal_surat' => $tanggal_surat,
                'perihal' => $request->perihal,
                'pembebanan_biaya' => $request->pembebanan_biaya,
                'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
                'tanggal_kembali' => $request->tanggal_kembali,
                'lama_hari' => $lama_hari,
                'keterangan' => $request->keterangan,
                'jenis_kendaraan' => $request->jenis_kendaraan,
                'tujuan' => $request->tujuan,
                'status' => 'Menunggu RAB',
            ]);
            $penugasan->save();
        } else {
            //if pengikut != null create new penugasan
            $penugasan = PerjalananDinas::create([
                'user_id' => $request->user_id,
                'pengikut' => $request->pengikut,
                'nomor_surat' => $nomorSurat,
                'tanggal_surat' => $tanggal_surat,
                'perihal' => $request->perihal,
                'pembebanan_biaya' => $request->pembebanan_biaya,
                'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
                'tanggal_kembali' => $request->tanggal_kembali,
                'keterangan' => $request->keterangan,
                'jenis_kendaraan' => $request->jenis_kendaraan,
                'tujuan' => $request->tujuan,
                'status' => 'Menunggu RAB',
            ]);
            $penugasan->save();
        }


        // get user that send notification
        $pegawai = User::whereHas('pegawai', function ($query)  use ($request) {
            $query->where('user_id', $request->user_id);
        })->orwhereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();

        //send notification to user
        Notification::send($pegawai, new NotifPenugasanDinas($penugasan));

        return redirect('/perjalanan-dinas')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PerjalananDinas $penugasan)
    {
        $penugasan = PerjalananDinas::with('user', 'pengikut')->find($penugasan->id);
        $manajer = User::whereHas('jabatan', function ($query) {
            $query->where('nama_jabatan', 'GENERAL MANAGER');
        })->get();
        return view('perjalanandinas.suratTugas', compact('penugasan', 'manajer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPenugasan($id)
    {
        $penugasan = PerjalananDinas::with('user', 'pengikut')->find($id);
        return response()->json(
            ['penugasan' => $penugasan]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeRab(Request $request)
    {
        dd($request->all());
        // $penugasan_id = $request->dispo_id;
        // $penugasan = PerjalananDinas::find($penugasan_id);

        // $penugasan->status = 'Menunggu realisasi RAB';

        // $penugasan->save();

        // $penugasan->tiketPerjalanan()->create([
        //     'perjalanan_dinas_id' => $penugasan_id,
        //     'maskapai' => $request->maskapai,
        //     'harga_tiket' => $request->harga_tiket,
        //     'charge' => $request->charge,
        //     'total' => $request->total_tiket,
        // ]);

        // $penugasan->biayaHarian()->create([
        //     'perjalanan_dinas_id' => $penugasan_id,
        //     'biaya' => $request->biaya_harian,
        //     'total' => $request->total_harian,
        // ]);

        // $penugasan->biayaPenginapan()->create([
        //     'perjalanan_dinas_id' => $penugasan_id,
        //     'jumlah' => $request->jumlah_penginap,
        //     'biaya' => $request->biaya_penginapan,
        //     'total' => $request->total_penginapan,
        // ]);

        // if ($request->jenis != null) {
        //     foreach ($request->jumlah_lain as $key => $value) {
        //         $penugasan->biayaLain()->create([
        //             'perjalanan_dinas_id' => $penugasan_id,
        //             'jumlah' => $request->jumlah_lain[$key],
        //             'jenis' => $request->jenis[$key],
        //             'biaya' => $request->biaya_lain[$key],
        //             // 'total' => $request->total_lain[$key],
        //         ]);
        //     }
        // }

        // return redirect('/perjalanan-dinas')->with('success', 'RAB berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rabForm(PerjalananDinas $penugasan)
    {
        $penugasan = PerjalananDinas::with('user', 'pengikut')->find($penugasan->id);
        $manajer = User::whereHas('jabatan', function ($query) {
            $query->where('nama_jabatan', 'GENERAL MANAGER');
        })->get();
        return view('perjalanandinas.rabForm', compact('penugasan', 'manajer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //         <?php
        // // example code

        // $name = [
        //     'asd','sas', 'tta'
        // ];

        // $age = [
        //     12, 11, 21
        // ];

        // $transform = [];
        // foreach ($name as $key => $val) {
        //     array_push($transform, [
        //         'name' => $name[$key],
        //         'age' => $age[$key]
        //     ]); 
        // }

        // echo json_encode($transform);
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

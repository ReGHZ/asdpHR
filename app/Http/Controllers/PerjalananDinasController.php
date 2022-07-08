<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Pengikut;
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
        $penugasan = PerjalananDinas::with('pengikut')->get();
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
            'tujuan'                        => 'required',
        ], [
            'user_id.required'              => 'pegawai cuti harus diisi',
            'perihal.required'              => 'Perihal harus diisi',
            'pembebanan_biaya.required'     => 'Pembebanan Biaya harus diisi',
            'tanggal_keberangkatan.required' => 'Tanggal Keberangkatan harus diisi',
            'tanggal_kembali.required'      => 'Tanggal kembali harus sebelum tanggal mulai',
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
        $penugasan = PerjalananDinas::create([
            // 'user_id' => $request->user_id,
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

        $penugasan->pengikut()->create([
            'user_id' => $request->user_id,
        ]);

        if (!empty($request->pengikut)) {
            foreach ($request->pengikut as $pengikut) {
                $penugasan->pengikut()->create([
                    'user_id' => $pengikut,
                    'perjalanan_dinas_id' => $penugasan->id,
                ]);
            }
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
        $penugasan = PerjalananDinas::with('pengikut')->find($penugasan->id);
        $manajer = User::whereHas('jabatan', function ($query) {
            $query->where('nama_jabatan', 'GENERAL MANAGER');
        })->get();
        $pengikut = Pengikut::where('perjalanan_dinas_id', $penugasan->id)->get();
        return view('perjalanandinas.suratTugas', compact('penugasan', 'manajer', 'pengikut'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPenugasan($id)
    {
        $penugasan = PerjalananDinas::with('pengikut')->find($id);
        return response()->json(
            ['penugasan' => $penugasan]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createRab(PerjalananDinas $penugasan)
    {
        //get data penugasan with pegawai and pengikut
        $penugasan = PerjalananDinas::with('pengikut')->find($penugasan->id);
        $pegawai = User::all();
        return view('perjalanandinas.createRab', compact('penugasan', 'pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeRab(Request $request)
    {
        // dd($request->all());
        $penugasan = PerjalananDinas::with('pengikut')->where('id', $request->penugasan_id)->first();


        $penugasan->status = "Berlangsung";
        $penugasan->save();

        return redirect('perjalanan-dinas')->with('success', 'Data RAB ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rabForm(PerjalananDinas $penugasan)
    {
        //get data penugasan
        $penugasan = PerjalananDinas::find($penugasan->id);
        //get data manajer
        $manajer = User::whereHas('jabatan', function ($query) {
            $query->where('nama_jabatan', 'GENERAL MANAGER');
        })->get();
        //get data pengikut
        $pengikut = Pengikut::where('perjalanan_dinas_id', $penugasan->id)->get();
        return view('perjalanandinas.rabForm', compact('penugasan', 'manajer', 'rab', 'pengikut'));
        // dd($array);
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

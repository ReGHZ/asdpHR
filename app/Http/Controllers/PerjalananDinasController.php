<?php

namespace App\Http\Controllers;

use App\Models\BiayaLain;
use App\Models\Divisi;
use App\Models\Pengikut;
use App\Models\PerjalananDinas;
use App\Models\Rab;
use App\Models\Realisasi;
use App\Models\User;
use App\Notifications\NotifPenugasanDinas;
use App\Notifications\NotifSelesaiDinas;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class PerjalananDinasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:daftar.dinas', ['only' => ['index']]);
        $this->middleware('permission:delete.dinas', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            //get data penugasan with pegawai and pengikut
            $penugasan = PerjalananDinas::with('pengikut')->get();
            $pegawai = User::all();
            $divisi = Divisi::all();
            return view('perjalanandinas.index', compact('penugasan', 'pegawai', 'divisi'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
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
            'nomor_surat' => $nomorSurat + 1,
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
        try {
            //get data penugasan with pengikut
            $penugasan = PerjalananDinas::with('pengikut')->find($penugasan->id);

            //get data user manajer
            $manajer = User::whereHas('jabatan', function ($query) {
                $query->where('nama_jabatan', 'GENERAL MANAGER');
            })->get();

            //get data pengikut
            $pengikut = Pengikut::where('perjalanan_dinas_id', $penugasan->id)->get();
            return view('perjalanandinas.suratTugas', compact('penugasan', 'manajer', 'pengikut'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //get data penugasan from request by id
        $penugasan_id = $request->input('penugasan_id');

        //find penugasan id
        $penugasan = PerjalananDinas::find($penugasan_id);

        //delete prjalanan dinas
        if ($penugasan != null) {
            $penugasan->delete();
            return redirect()->back()->with(['success' => 'Penugasan berhasil dihapus']);
        }

        return redirect()->back()->with(['error' => 'Id Salah!!']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createRab(PerjalananDinas $penugasan)
    {
        try {
            //get data penugasan
            $penugasan = PerjalananDinas::find($penugasan->id);
            //get data rab
            $rab = Rab::with('biayaLain')->where('perjalanan_dinas_id', $penugasan->id)->get();
            return view('perjalanandinas.rab.createRab', compact('penugasan', 'rab'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeRab(Request $request)
    {

        //validate request
        $request->validate([
            'biaya_harian'        => 'required',
            'jumlah_biaya_harian' => 'required',
            'total'               => 'required',
            'pengikut_id'         => 'required',
        ], [

            'biaya_harian.required'        => 'biaya Harian harus diisi',
            'jumlah_biaya_harian.required' => 'jumlah biaya harian harus ada',
            'total.required'               => 'Total harus ada',
            'pengikut_id.required'         => 'nama harus ada',
        ]);

        //get penugasan by id
        $penugasan = PerjalananDinas::where('id', $request->penugasan_id)->first();

        //create rab
        $rab = Rab::create([
            'perjalanan_dinas_id' => $penugasan->id,
            'pengikut_id' => $request->pengikut_id,
            //tiket perjalanan dinas
            'maskapai' => $request->maskapai,
            'harga_tiket' => $request->harga_tiket,
            'tempat_berangkat' => $request->tempat_berangkat,
            'tempat_tujuan' => $request->tempat_tujuan,
            'charge' => $request->charge,
            'jumlah_harga_tiket' => $request->jumlah_harga_tiket,
            //biaya harian
            'lama_hari' => $request->lama_hari,
            'biaya_harian' => $request->biaya_harian,
            'jumlah_biaya_harian' => $request->jumlah_biaya_harian,
            //biaya penginaran
            'lama_hari_penginap' => $request->lama_hari_penginap,
            'biaya_penginapan' => $request->biaya_penginapan,
            'jumlah_biaya_penginapan' => $request->jumlah_biaya_penginapan,
            //total
            'total' => $request->total,
            //biaya lain
            'jumlah_biaya_lain' => $request->jumlah_biaya_lain,
            //kas
            'uang_muka' => $request->uang_muka,
            'tanggal_uang_muka' => $request->tanggal_uang_muka,
            'biaya_kas' => $request->biaya_kas,
            'biaya_ybs' => $request->biaya_ybs,
        ]);

        foreach ($request->biaya_lain as $key => $value) {
            $rab->biayaLain()->create([
                'rab_id' => $rab->id,
                'qty' => $request->qty[$key],
                'jenis' => $request->jenis[$key],
                'biaya' => $value,
            ]);
        }
        //update status penugasan ke berlangsung
        $penugasan->status = "Berlangsung";
        $penugasan->save();

        return redirect()->back()->with('success', 'Data RAB ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editRab(Request $request)
    {
        try {
            //get data rab
            $rab_id = $request->rab_id;
            $rab = Rab::find($rab_id);

            $rab->maskapai                  = $request->maskapai;
            $rab->harga_tiket               = $request->harga_tiket;
            $rab->tempat_berangkat          = $request->tempat_berangkat;
            $rab->tempat_tujuan             = $request->tempat_tujuan;
            $rab->charge                    = $request->charge;
            $rab->jumlah_harga_tiket        = $request->jumlah_harga_tiket;
            $rab->lama_hari                 = $request->lama_hari;
            $rab->biaya_harian              = $request->biaya_harian;
            $rab->jumlah_biaya_harian       = $request->jumlah_biaya_harian;
            $rab->lama_hari_penginap        = $request->lama_hari_penginap;
            $rab->biaya_penginapan          = $request->biaya_penginapan;
            $rab->jumlah_biaya_penginapan   = $request->jumlah_biaya_penginapan;
            $rab->total                     = $request->total;
            $rab->jumlah_biaya_lain         = $request->jumlah_biaya_lain;
            $rab->uang_muka                 = $request->uang_muka;
            $rab->tanggal_uang_muka         = $request->tanggal_uang_muka;
            $rab->biaya_kas                 = $request->biaya_kas;
            $rab->biaya_ybs                 = $request->biaya_ybs;

            $pengajuan = $rab->perjalananDinas;
            $pengajuan->status = "Selesai";

            //get biayalain
            $biayaLain = $rab->biayaLain;

            //store biayalain in array
            $biayaLain_id = [];

            //get same biayaLain_id to requ3est biaya lain
            foreach ($biayaLain as $key => $value) {
                array_push($biayaLain_id, $value->id);
            }

            //get different value from request biaya lain to delete
            $hapus_biayalain = array_diff($biayaLain_id, $request->biayaLain_id);
            foreach ($hapus_biayalain as $key => $value) {
                $rab->biayaLain()->where('id', $value)->delete();
            }

            //request biayalain_id to update or create
            foreach ($request->biayaLain_id as $key => $value) {
                $data = array(
                    'id' => $value,
                    'rab_id' => $rab_id,
                    'qty' => $request->qty[$key],
                    'jenis' => $request->jenis[$key],
                    'biaya' => $request->biaya_lain[$key],
                );

                $new = BiayaLain::updateOrCreate(
                    ['rab_id' => $rab_id, 'id' => $value],
                    $data
                );
            }

            $rab->update();
            $pengajuan->update();
            return redirect()->back()->with('success', 'Data RAB berhasil diedit');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error', 'Data RAB gagal diedit']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rabForm(Rab $rab)
    {
        try {
            //get data rab
            $rab = Rab::find($rab->id);
            //get data manajer
            $manajer = User::whereHas('jabatan', function ($query) {
                $query->where('nama_jabatan', 'GENERAL MANAGER');
            })->get();
            return view('perjalanandinas.rab.rabForm', compact('rab', 'manajer'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyRab(Request $request)
    {
        //get data penugasan from request by id
        $rab_id = $request->input('rab_id');

        //find penugasan id
        $rab = Rab::find($rab_id);

        //delete prjalanan dinas
        if ($rab != null) {
            $rab->delete();
            return redirect()->back()->with(['success' => 'Rab berhasil dihapus']);
        }

        return redirect()->back()->with(['error' => 'Id Salah!!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function realisasiRab(Request $request)
    {

        //get data rab
        $rab_id = $request->rab_id;
        $rab = Rab::find($rab_id);

        //create realisasi
        $realisasi = Realisasi::create([
            'rab_id' => $rab->id,
            //tiket perjalanan dinas
            'maskapai' => $request->maskapai,
            'harga_tiket' => $request->harga_tiket,
            'tempat_berangkat' => $request->tempat_berangkat,
            'tempat_tujuan' => $request->tempat_tujuan,
            'charge' => $request->charge,
            'jumlah_harga_tiket' => $request->jumlah_harga_tiket,
            //biaya harian
            'lama_hari' => $request->lama_hari,
            'biaya_harian' => $request->biaya_harian,
            'jumlah_biaya_harian' => $request->jumlah_biaya_harian,
            //biaya penginaran
            'lama_hari_penginap' => $request->lama_hari_penginap,
            'biaya_penginapan' => $request->biaya_penginapan,
            'jumlah_biaya_penginapan' => $request->jumlah_biaya_penginapan,
            //total
            'total' => $request->total,
            //biaya lain
            'jumlah_biaya_lain' => $request->jumlah_biaya_lain,
            //kas
            'uang_muka' => $request->uang_muka,
            'tanggal_uang_muka' => $request->tanggal_uang_muka,
            'biaya_kas' => $request->biaya_kas,
            'biaya_ybs' => $request->biaya_ybs,
        ]);

        foreach ($request->biaya_lain as $key => $value) {
            $realisasi->realisasiBLain()->create([
                'realisasi_id' => $realisasi->id,
                'qty' => $request->qty[$key],
                'jenis' => $request->jenis[$key],
                'biaya' => $value,
            ]);
        }

        //update status penugasan ke Selesai
        $pengajuan = $rab->perjalananDinas;
        $pengajuan->status = "Selesai";
        $pengajuan->save();

        return redirect()->back()->with('success', 'Data Realisasi ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function realisasiForm(Rab $rab)
    {
        try {
            //get data rab
            $rab = Rab::find($rab->id);
            //get data realisasi
            $realisasi = Realisasi::where('rab_id', $rab->id)->first();
            //get data manajer
            $manajer = User::whereHas('jabatan', function ($query) {
                $query->where('nama_jabatan', 'GENERAL MANAGER');
            })->get();
            return view('perjalanandinas.realisasi.realisasiForm', compact('rab', 'realisasi', 'manajer'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function laporanRealisasiForm(Rab $rab)
    {
        try {
            //get data rab
            $rab = Rab::find($rab->id);
            //get data realisasi
            $realisasi = Realisasi::where('rab_id', $rab->id)->first();
            //get data manajer
            $manajer = User::whereHas('jabatan', function ($query) {
                $query->where('nama_jabatan', 'GENERAL MANAGER');
            })->get();
            return view('perjalanandinas.realisasi.laporanRealisasi', compact('rab', 'realisasi', 'manajer'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function indexLaporan()
    {
        try {
            //get auth user
            $user = Auth::user();

            //get data perjalanan dinas
            $penugasan = Pengikut::with('perjalananDinas')->whereHas('perjalananDinas', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();

            return view('perjalanandinas.laporan.index', compact('penugasan'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tandaiSelesai(Request $request)
    {
        try {
            $penugasan_id = $request->input('penugasan_id');

            $penugasan = PerjalananDinas::find($penugasan_id);
            $penugasan->status = "Menunggu Realisasi";
            $penugasan->update();

            // get user to send notification
            $user = User::whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })->get();

            //send notification to admin
            Notification::send($user, new NotifSelesaiDinas($penugasan));

            return redirect()->back()->with('success', 'Data berhasil ditandai selesai');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error', 'Data gagal ditandai selesai']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function kebenaran(Rab $rab)
    {
        try {
            //get data rab
            $rab = Rab::find($rab->id);
            $realisasi = Realisasi::where('rab_id', $rab->id)->first();
            return view('perjalanandinas.laporan.kebenaranForm', compact('rab', 'realisasi'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}

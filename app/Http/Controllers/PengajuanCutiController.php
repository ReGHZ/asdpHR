<?php

namespace App\Http\Controllers;


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
use Illuminate\Support\Facades\File;

class PengajuanCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //get all data cuti
        $dataCuti = PengajuanCuti::with('user')->get();

        return view('cuti.index', compact('dataCuti'));
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
            'jenis_cuti'                         => 'required',
            'keterangan'                         => 'required',
            'tanggal_mulai'                      => 'required|date',
            'tanggal_selesai'                    => 'required|date|after_or_equal:tanggal_mulai',
        ], [
            'jenis_cuti.required'                => 'Jenis cuti harus diisi',
            'keterangan.required'                => 'Keterangan harus diisi',
            'tanggal_mulai.required'             => 'Tanggal Mulai harus diisi',
            'tanggal_selesai.required'           => 'Tanggal selesai harus sebelum tanggal mulai',
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

        // Condition if user select cuti tahunan and check condition for kuota cuti
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

        // Condition if user select cuti besar
        if ($request->jenis_cuti == 'Cuti besar') {
            $cuti = $lama_hari > 90;
            if ($cuti) {
                return redirect()->back()->with('error', 'Cuti besar hanya bisa 90 hari atau 3 bulan');
            }
        }

        // Condition if user select cuti bersalin
        if ($request->jenis_cuti == 'Cuti bersalin') {
            $cuti = $lama_hari > 45;
            if ($cuti) {
                return redirect()->back()->with('error', 'Cuti bersalin hanya bisa 45 hari atau 1.5 bulan');
            }
        }

        // Condition if user select cuti sakit
        if ($request->jenis_cuti == 'Cuti sakit') {
            $cuti = $lama_hari > 14;
            if ($cuti) {
                return redirect()->back()->with('error', 'Cuti sakit hanya bisa 14 hari dan harus disertai surat dokter');
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
            'status'                => 'Menunggu konfirmasi',

        ]);

        //if user select cuti sakit and upload file surat keterangan dokter
        if ($request->jenis_cuti == 'Cuti sakit') {
            if ($request->hasFile('file_surat_dokter')) {
                $request->file('file_surat_dokter')->move('suratDokter/', $request->file('file_surat_dokter')->getClientOriginalName());
                $cuti->file_surat_dokter = $request->file('file_surat_dokter')->getClientOriginalName();
                $cuti->save();
            }
        }

        $cuti->save();

        //get data user that have role admin & manajer
        $user = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin')->orWhere('name', 'manajer');
        })->get();
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
    public function show(PengajuanCuti $pengajuan)
    {
        //get data pengajuan cuti and get user where have jabatan manajer
        $pengajuan = PengajuanCuti::with('user.pegawai')->findOrFail($pengajuan->id);
        $manajerSDM = User::where('jabatan_id', 3)->get();
        return view('cuti.suratCuti', compact('pengajuan', 'manajerSDM'));
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
        //when cuti tahunan ditolak kuota cuti dikembalikan
        if ($pengajuan->jenis_cuti == 'Cuti tahunan') {
            $cuti = Pegawai::where('id', $pengajuan->user_id)->first();
            $cuti->kuota_cuti = $cuti->kuota_cuti + $pengajuan->lama_hari;
            $cuti->update();
        }

        //update status to ditolak when reject
        $pengajuan->status = 'Ditolak';
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

        //update status to disetujui when approve
        $pengajuan->status = 'Disetujui';
        $pengajuan->update();

        //create file persetujuan cuti when approve
        $pengajuan->persetujuanCuti()->create([
            'pengajuan_cuti_id' => $pengajuan->id,
            'user_id' => $pengajuan->user_id,
            'nomor_surat' => $nomorSurat,
            'tanggal_surat' => $pengajuan->tanggal_surat,
            'keterangan' => $pengajuan->keterangan,
        ]);

        //get user that send notification
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
    public function destroy(Request $request)
    {
        //get data pengajuan cuti from request by id
        $cuti_id = $request->input('cuti_id');

        //find pengajuan cuti id
        $pengajuan = PengajuanCuti::find($cuti_id);

        //delete file pengajuan cuti sakit
        if ($pengajuan->jenis_cuti == 'Cuti sakit') {
            if ($pengajuan->file_surat_dokter != null) {
                $lokasi = 'suratDokter/' . $pengajuan->file_surat_dokter;
                if (File::exists($lokasi)) {
                    File::delete($lokasi);
                }
            }
        }

        //delete pengajuan cuti
        if ($pengajuan != null) {
            $pengajuan->delete();
            return redirect()->route('pengajuan-cuti')->with(['success' => 'Pengajuan berhasil dihapus']);
        }

        return redirect()->route('pengajuan-cuti')->with(['success' => 'Id Salah!!']);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function markNotif($id)
    {
        //if get id auth user marj notif
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
        //mark all auth user notif
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function downloadFile($id)
    {
        //find pengajuan cuti id
        $pengajuan = PengajuanCuti::find($id);

        //download file 
        $file = public_path() . '/suratDokter/' . $pengajuan->file_surat_dokter;
        return response()->download($file);
    }
}

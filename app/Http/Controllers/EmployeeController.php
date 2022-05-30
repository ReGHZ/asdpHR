<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $divisi = Divisi::all();
        $jabatan = Jabatan::all();
        $user = User::with('pegawai')->get();
        return view('employee.index', compact('divisi', 'jabatan', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'name'                      => 'required',
            'email'                     => 'required',
            'password'                  => 'required',
            'jabatan_id'                => 'required',
            'divisi_id'                 => 'required',
            'nik'                       => 'required',
            'tempat_lahir'              => 'required',
            'tanggal_lahir'             => 'required',
            'jenis_kelamin'             => 'required',
            'tanggal_masuk_kerja'       => 'required',
            'tanggal_pilih_jabatan'     => 'required',

        ], [
            'name.required'                      => 'nama Pegawai harus diisi',
            'email.required'                     => 'Email Pegawai harus diisi',
            'password.required'                  => 'Password Pegawai harus diisi',
            'jabatan_id.required'                => 'jabatan harus diisi',
            'divisi_id.required'                 => 'divisi harus diisi',
            'nik.required'                       => 'NIK harus diisi',
            'tempat_lahir.required'              => 'tempat lahir harus diisi',
            'tanggal_lahir.required'             => 'tanggal lahir harus diisi',
            'jenis_kelamin.required'             => 'jenis kelamin harus diisi',
            'tanggal_masuk_kerja.required'       => 'tanggal masuk kerja harus diisi',
            'tanggal_pilih_jabatan.required'     => 'tanggal dipilih jabatan harus diisi',
        ]);

        //calculate umur
        $tanggal_lahir = Carbon::parse($request['tanggal_lahir']);
        $usia = $tanggal_lahir->age;

        //calculate masa kerja
        $tanggal_masuk_kerja = Carbon::parse($request['tanggal_masuk_kerja']);
        $masa_kerja = $tanggal_masuk_kerja->diff(\Carbon\Carbon::now())->format('%y Tahun, %m Bulan');
        //calculate masa jabatan
        $tanggal_pilih_jabatan = Carbon::parse($request['tanggal_pilih_jabatan']);
        $masa_jabatan = $tanggal_pilih_jabatan->diff(\Carbon\Carbon::now())->format('%y Tahun, %m Bulan');

        $pegawai = User::create([
            'name'                      => $request->name,
            'email'                     => $request->email,
            'password'                  => Hash::make($request->password),

            'jabatan_id'                => $request->jabatan_id,
            'divisi_id'                 => $request->divisi_id,
            'nik'                       => $request->nik,
            'tempat_lahir'              => $request->tempat_lahir,
            'tanggal_lahir'             => $tanggal_lahir,
            'usia'                      => $usia,
            'jenis_kelamin'             => $request->jenis_kelamin,
            'no_hp'                     => $request->no_hp,
            'alamat'                    => $request->alamat,
            'tanggal_masuk_kerja'       => $tanggal_masuk_kerja,
            'masa_kerja'                => $masa_kerja,
            'tanggal_pilih_jabatan'     => $tanggal_pilih_jabatan,
            'masa_jabatan'              => $masa_jabatan,
        ]);


        $pegawai->pegawai()->create([
            'user_id'                   => $pegawai->id,

        ]);

        return redirect('/employee')->with('sukses', 'Pegawai berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $divisi = Divisi::all();
        $jabatan = Jabatan::all();
        $pegawai = User::findorfail($id);
        return view('employee.show', compact('pegawai', 'divisi', 'jabatan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('pegawai')->find($id);

        return response()->json([
            'status' => 200,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePegawai(Request $request)
    {
        $request->validate([
            'name'                      => 'required',
            'email'                     => 'required',
            'jabatan_id'                => 'required',
            'divisi_id'                 => 'required',
            'nik'                       => 'required',
            'tempat_lahir'              => 'required',
            'tanggal_lahir'             => 'required',
            'jenis_kelamin'             => 'required',
            'tanggal_masuk_kerja'       => 'required',
            'tanggal_pilih_jabatan'     => 'required',

        ], [
            'name.required'                      => 'nama Pegawai harus diisi',
            'email.required'                     => 'Email Pegawai harus diisi',
            'jabatan_id.required'                => 'jabatan harus diisi',
            'divisi_id.required'                 => 'divisi harus diisi',
            'nik.required'                       => 'NIK harus diisi',
            'tempat_lahir.required'              => 'tempat lahir harus diisi',
            'tanggal_lahir.required'             => 'tanggal lahir harus diisi',
            'jenis_kelamin.required'             => 'jenis kelamin harus diisi',
            'tanggal_masuk_kerja.required'       => 'tanggal masuk kerja harus diisi',
            'tanggal_pilih_jabatan.required'     => 'tanggal dipilih jabatan harus diisi',
        ]);

        $tanggal_lahir = Carbon::parse($request['tanggal_lahir']);
        $usia = $tanggal_lahir->age;

        //calculate masa kerja
        $tanggal_masuk_kerja = Carbon::parse($request['tanggal_masuk_kerja']);
        $masa_kerja = $tanggal_masuk_kerja->diff(\Carbon\Carbon::now())->format('%y Tahun, %m Bulan');
        //calculate masa jabatan
        $tanggal_pilih_jabatan = Carbon::parse($request['tanggal_pilih_jabatan']);
        $masa_jabatan = $tanggal_pilih_jabatan->diff(\Carbon\Carbon::now())->format('%y Tahun, %m Bulan');

        $emp_id = $request->emp_id;
        $pegawai = User::find($emp_id);

        $pegawai->name = $request->name;
        $pegawai->email = $request->email;
        if ($request->password != null) {
            $pegawai->password = Hash::make($request->password);
        }
        $pegawai->jabatan_id = $request->jabatan_id;
        $pegawai->divisi_id = $request->divisi_id;
        $pegawai->nik = $request->nik;
        $pegawai->tempat_lahir = $request->tempat_lahir;
        $pegawai->tanggal_lahir = $request->tanggal_lahir;
        $pegawai->usia = $usia;
        $pegawai->jenis_kelamin = $request->jenis_kelamin;
        $pegawai->no_hp = $request->no_hp;
        $pegawai->alamat = $request->alamat;
        $pegawai->tanggal_masuk_kerja = $request->tanggal_masuk_kerja;
        $pegawai->masa_kerja = $masa_kerja;
        $pegawai->tanggal_pilih_jabatan = $request->tanggal_pilih_jabatan;
        $pegawai->masa_jabatan = $masa_jabatan;

        $pegawai->update();

        return redirect()->back()->with('success', 'Data Pegawai Berhasil Diubah');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePersonal(Request $request)
    {
        $per_id = $request->per_id;
        $pegawai = User::find($per_id);

        $pegawai->pegawai()->update([
            'status_keluarga'   => $request->status_keluarga,
            'pendidikan'        => $request->pendidikan,
            'jurusan'           => $request->jurusan,
            'nik_ktp'           => $request->nik_ktp,
            'no_rek'            => $request->no_rek,
            'npwp'              => $request->npwp,
            'ukuran_baju'       => $request->ukuran_baju,
            'ukuran_sepatu'     => $request->ukuran_sepatu,
        ]);

        return redirect()->back()->with('success', 'Data personal Berhasil Diubah');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateKantor(Request $request)
    {
        $kan_id = $request->kan_id;
        $pegawai = User::find($kan_id);

        $pegawai->pegawai()->update([
            'sk'                        => $request->sk,
            'segmen'                    => $request->segmen,
            'no_bpjs_kesehatan'         => $request->no_bpjs_kesehatan,
            'no_bpjs_ketenagakerjaan'   => $request->no_bpjs_ketenagakerjaan,
            'no_inhealth'               => $request->no_inhealth,
            'darat_laut_lokasi'         => $request->darat_laut_lokasi,
            'gol_skala_tht'             => $request->gol_skala_tht,
            'skala_tht'                 => $request->skala_tht,
            'gol_skala_phdp'            => $request->gol_skala_phdp,
            'gol_phdp'                  => $request->gol_phdp,
            'gol_skala_gaji'            => $request->gol_skala_gaji,
            'gol_gaji'                  => $request->gol_gaji,
        ]);

        return redirect()->back()->with('success', 'Data Kantor Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = User::find($id);
        if ($pegawai != null) {
            $pegawai->delete();
            return redirect()->route('employee')->with(['message' => 'Pegawai berhasil dihapus']);
        }

        return redirect()->route('employee')->with(['message' => 'Id Salah!!']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Personal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
        $pegawai = Pegawai::with('user')->get();
        return view('employee.index', compact('divisi', 'jabatan', 'pegawai'));
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
            'jabatan_id'                => 'required',
            'divisi_id'                 => 'required',
            'nik'                       => 'required',
            'tempat_lahir'              => 'required',
            'tanggal_lahir'             => 'required',
            'tanggal_masuk_kerja'       => 'required',
            'tanggal_pilih_jabatan'     => 'required',
            'jenis_kelamin'             => 'required',

        ], [
            'name.required'                      => 'nama Pegawai harus diisi',
            'jabatan_id.required'                => 'jabatan harus diisi',
            'divisi_id.required'                 => 'sub unker harus diisi',
            'nik.required'                       => 'NIK harus diisi',
            'tempat_lahir.required'              => 'tempat lahir harus diisi',
            'tanggal_lahir.required'             => 'tanggal lahir harus diisi',
            'tanggal_masuk_kerja.required'       => 'tanggal masuk kerja harus diisi',
            'tanggal_pilih_jabatan.required'     => 'tanggal dipilih jabatan harus diisi',
            'jenis_kelamin.required'             => 'jenis kelamin harus diisi'
        ]);

        $employee = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
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

        $pegawai = Pegawai::create([
            'user_id'                   => $employee->id,
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

        $personal = Personal::create([
            'pegawai_id'               => $pegawai->id,
        ]);

        $personal->save();
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
        $pegawai = Pegawai::findorfail($id);
        return view('employee.show', compact('pegawai'));
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
        $pegawai = Pegawai::find($id);
        if ($pegawai != null) {
            $pegawai->user()->delete();
            return redirect()->route('employee')->with(['message' => 'Pegawai berhasil dihapus']);
        }

        return redirect()->route('employee')->with(['message' => 'Id Salah!!']);
    }
}

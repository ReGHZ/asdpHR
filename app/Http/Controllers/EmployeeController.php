<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use jeremykenedy\LaravelRoles\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get data divisi and jabatan
        $divisi = Divisi::all();
        $jabatan = Jabatan::all();

        //get data user 
        $user = User::with('pegawai')->get();

        //get data role
        $allRoles = Role::all();
        return view('employee.index', compact('divisi', 'jabatan', 'user', 'allRoles'));
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
        //validator
        $request->validate([
            'name'                      => 'required',
            'email'                     => 'required',
            'password'                  => 'required',
            'jabatan_id'                => 'required',
            'divisi_id'                 => 'required',
            'nik'                       => 'required|unique:users,nik',
            'tempat_lahir'              => 'required',
            'tanggal_lahir'             => 'required',
            'jenis_kelamin'             => 'required',
            'tanggal_masuk_kerja'       => 'required',
            'tanggal_pilih_jabatan'     => 'required',
            'role'                      => 'required',

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
            'role.required'                      => 'Role harus diisi',
        ]);

        //calculate usia
        $tanggal_lahir = Carbon::parse($request['tanggal_lahir']);
        $usia = $tanggal_lahir->age;

        //calculate masa kerja
        $tanggal_masuk_kerja = Carbon::parse($request['tanggal_masuk_kerja']);
        $masa_kerja = $tanggal_masuk_kerja->diff(\Carbon\Carbon::now())->format('%y Tahun, %m Bulan');
        //calculate masa jabatan
        $tanggal_pilih_jabatan = Carbon::parse($request['tanggal_pilih_jabatan']);
        $masa_jabatan = $tanggal_pilih_jabatan->diff(\Carbon\Carbon::now())->format('%y Tahun, %m Bulan');

        //user create
        $user = User::create([
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

        //user create relation table pegawai
        $user->pegawai()->create([
            'user_id'                   => $user->id,
            'kuota_cuti'                => $request->kuota_cuti = 12,

        ]);

        //upload foto pegawai
        if ($request->hasFile('foto')) {


            $request->file('foto')->move('fotoPegawai/', $request->file('foto')->getClientOriginalName());
            $user->pegawai->foto = $request->file('foto')->getClientOriginalName();
            $user->pegawai->save();
        }

        //attach role user
        $user->roles()->attach($request->role);

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
        // get data user
        $divisi = Divisi::all();
        $jabatan = Jabatan::all();
        $allRoles = Role::all();
        $user = User::findorfail($id);
        return view('employee.show', compact('user', 'divisi', 'jabatan', 'allRoles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get user dengan relasi pegawai
        $user = User::with('pegawai')->find($id);
        //sync role user
        $roles = $user->roles()->get();

        return response()->json([
            'status' => 200,
            'user' => $user,
            'roles' => $roles,

        ]);
        // return dd($user);
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
        //user id
        $emp_id = $request->emp_id;
        $user = User::find($emp_id);

        //validator
        $request->validate([
            'name'                      => 'required',
            'email'                     => ['required', 'unique:users,email,' . $emp_id],
            'jabatan_id'                => 'required',
            'divisi_id'                 => 'required',
            'nik'                       => ['required', 'unique:users,nik,' . $emp_id],
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

        //calculate usia
        $tanggal_lahir = Carbon::parse($request['tanggal_lahir']);
        $usia = $tanggal_lahir->age;

        //calculate masa kerja
        $tanggal_masuk_kerja = Carbon::parse($request['tanggal_masuk_kerja']);
        $masa_kerja = $tanggal_masuk_kerja->diff(\Carbon\Carbon::now())->format('%y Tahun, %m Bulan');
        //calculate masa jabatan
        $tanggal_pilih_jabatan = Carbon::parse($request['tanggal_pilih_jabatan']);
        $masa_jabatan = $tanggal_pilih_jabatan->diff(\Carbon\Carbon::now())->format('%y Tahun, %m Bulan');

        //update data
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        $user->jabatan_id = $request->jabatan_id;
        $user->divisi_id = $request->divisi_id;
        $user->nik = $request->nik;
        $user->tempat_lahir = $request->tempat_lahir;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->usia = $usia;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;
        $user->tanggal_masuk_kerja = $request->tanggal_masuk_kerja;
        $user->masa_kerja = $masa_kerja;
        $user->tanggal_pilih_jabatan = $request->tanggal_pilih_jabatan;
        $user->masa_jabatan = $masa_jabatan;

        $user->update();

        //detach role user
        $user->detachRole($user->roles);

        //attach role user
        $user->attachRole($request->role);

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
        //user id
        $per_id = $request->per_id;
        $user = User::find($per_id);

        //update data pegawai
        $user->pegawai()->update([
            'status_keluarga'           => $request->status_keluarga,
            'pendidikan'                => $request->pendidikan,
            'jurusan'                   => $request->jurusan,
            'nik_ktp'                   => $request->nik_ktp,
            'no_bpjs_kesehatan'         => $request->no_bpjs_kesehatan,
            'no_bpjs_ketenagakerjaan'   => $request->no_bpjs_ketenagakerjaan,
            'no_rek'                    => $request->no_rek,
            'npwp'                      => $request->npwp,
            'ukuran_baju'               => $request->ukuran_baju,
            'ukuran_sepatu'             => $request->ukuran_sepatu,
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
        //user id
        $kan_id = $request->kan_id;
        $user = User::find($kan_id);

        //update data kantor
        $user->pegawai()->update([
            'sk'                        => $request->sk,
            'segmen'                    => $request->segmen,
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateFotoPegawai(Request $request, $id)
    {
        //user id
        $user = User::find($id);

        //update foto pegawai
        if ($request->hasFile('foto')) {

            $lokasi = 'fotoPegawai/' . $user->pegawai->foto;
            if (File::exists($lokasi)) {
                File::delete($lokasi);
            }
            $request->file('foto')->move('fotoPegawai/', $request->file('foto')->getClientoriginalName());
            $user->pegawai->foto = $request->file('foto')->getClientOriginalName();
            $user->pegawai->update();
        }

        return redirect()->back()->with('success', 'Foto Pegawai Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //user id
        $user = User::find($id);

        //delete user
        if ($user != null) {
            $user->delete();
            return redirect()->route('employee')->with(['success' => 'Pegawai berhasil dihapus']);
        }

        return redirect()->route('employee')->with(['success' => 'Id Salah!!']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jabatan = Jabatan::all();
        return view('employee.positions.index', compact('jabatan'));
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
            'nama_jabatan'                      => 'required',

        ], [
            'nama_jabatan.required'             => 'Nama jabatan harus diisi',
        ]);

        $jabatan = Jabatan::create(
            [
                'nama_jabatan' => $request->nama_jabatan,
                'deskripsi' => $request->deskripsi
            ]
        );

        $jabatan->save();
        return redirect('jabatan')->with('success', 'Data Jabatan Berhasil Ditambahkan');
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
        $jabatan = Jabatan::find($id);

        return response()->json([
            'status' => 200,
            'jabatan' => $jabatan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama_jabatan'                      => 'required',

        ], [
            'nama_jabatan.required'             => 'Nama jabatan harus diisi',
        ]);

        $jab_id = $request->jab_id;
        $jabatan = Jabatan::find($jab_id);
        $jabatan->nama_jabatan = $request->nama_jabatan;
        $jabatan->deskripsi = $request->deskripsi;

        $jabatan->update();

        return redirect('jabatan')->with('success', 'Data jabatan Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jabatan = Jabatan::find($id);
        if ($jabatan != null) {
            $jabatan->delete();
            return redirect()->route('jabatan')->with(['message' => 'Jabatan berhasil dihapus']);
        }

        return redirect()->route('jabatan')->with(['message' => 'Id Salah!!']);
    }
}

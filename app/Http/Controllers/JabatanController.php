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
        //get all jabatan
        $jabatan = Jabatan::all();
        return view('employee.positions.index', compact('jabatan'));
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
            'nama_jabatan'                      => 'required',

        ], [
            'nama_jabatan.required'             => 'Nama jabatan harus diisi',
        ]);

        //create new jabatan
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //find jabatan by id
        $jabatan = Jabatan::find($id);

        // return json with jabatan
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
        //validate request
        $request->validate([
            'nama_jabatan'                      => 'required',

        ], [
            'nama_jabatan.required'             => 'Nama jabatan harus diisi',
        ]);

        //find jabatan by id and update jabatan
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
    public function destroy(Request $request)
    {
        //get jabatan id from request by id
        $jabatan_id = $request->input('jabatan_id');

        //find jabatan by id and delete jabatan
        $jabatan = Jabatan::find($jabatan_id);
        if ($jabatan != null) {
            $jabatan->delete();
            return redirect()->route('jabatan')->with(['success' => 'Jabatan berhasil dihapus']);
        }

        return redirect()->route('jabatan')->with(['success' => 'Id Salah!!']);
    }
}

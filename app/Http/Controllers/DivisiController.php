<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {

        $this->middleware('permission:daftar.divisi', ['only' => ['index']]);
        $this->middleware('permission:create.divisi', ['only' => ['store']]);
        $this->middleware('permission:edit.divisi', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete.divisi', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            //get all divisi
            $divisi = Divisi::all();
            return view('pegawai.divisi.index', compact('divisi'));
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
            'nama_divisi'                      => 'required',

        ], [
            'nama_divisi.required'             => 'Nama Divisi harus diisi',
        ]);

        //create new divisi
        $divisi = Divisi::create([
            'nama_divisi' => $request->nama_divisi,
            'deskripsi' => $request->deskripsi,
        ]);

        // return dd($divisi);

        $divisi->save();

        return redirect('divisi')->with('success', 'Data Divisi Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            //find divisi by id
            $divisi = Divisi::find($id);

            //return json with divisi
            return response()->json([
                'status' => 200,
                'divisi' => $divisi
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
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
            'nama_divisi'                      => 'required',

        ], [
            'nama_divisi.required'             => 'Nama Divisi harus diisi',
        ]);

        //find divisi by id and update divisi
        $div_id = $request->div_id;
        $divisi = Divisi::find($div_id);
        $divisi->nama_divisi = $request->nama_divisi;
        $divisi->deskripsi = $request->deskripsi;

        $divisi->update();

        return redirect('divisi')->with('success', 'Data Divisi Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //get divisi id from request by id
        $divisi_id = $request->input('divisi_id');

        //find divisi by id and delete jabatan
        $divisi = Divisi::find($divisi_id);
        if ($divisi != null) {
            $divisi->delete();
            return redirect()->route('divisi')->with(['success' => 'Divisi berhasil dihapus']);
        }

        return redirect()->route('divisi')->with(['error' => 'Id Salah!!']);
    }
}

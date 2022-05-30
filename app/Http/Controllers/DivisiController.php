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
    public function index()
    {
        $divisi = Divisi::all();
        return view('employee.departements.index', compact('divisi'));
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
            'nama_divisi'                      => 'required',

        ], [
            'nama_divisi.required'             => 'Nama Divisi harus diisi',
        ]);
        $divisi = Divisi::create([
            'nama_divisi' => $request->nama_divisi,
            'deskripsi' => $request->deskripsi,
        ]);

        // return dd($divisi);

        $divisi->save();

        return redirect('divisi')->with('success', 'Data Divisi Berhasil Ditambahkan');
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
        $divisi = Divisi::find($id);

        return response()->json([
            'status' => 200,
            'divisi' => $divisi
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
            'nama_divisi'                      => 'required',

        ], [
            'nama_divisi.required'             => 'Nama Divisi harus diisi',
        ]);

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
    public function destroy($id)
    {
        $divisi = Divisi::find($id);
        if ($divisi != null) {
            $divisi->delete();
            return redirect()->route('divisi')->with(['message' => 'Divisi berhasil dihapus']);
        }

        return redirect()->route('divisi')->with(['message' => 'Id Salah!!']);
    }
}

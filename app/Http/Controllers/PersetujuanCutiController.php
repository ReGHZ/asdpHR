<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\PersetujuanCuti;
use App\Models\User;
use Illuminate\Http\Request;

class PersetujuanCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persetujuan = PersetujuanCuti::with('pengajuanCuti')->get();
        return view('cuti.persetujuan.index', compact('persetujuan'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PersetujuanCuti $persetujuan)
    {
        $persetujuan = PersetujuanCuti::with('pengajuanCuti')->findOrFail($persetujuan->id);
        $manajer = User::where('jabatan_id', 9)->get();
        return view('cuti.persetujuan.suratIzinCuti', compact('persetujuan', 'manajer'));
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

<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\PersetujuanCuti;
use App\Models\Tembusan;
use App\Models\User;
use Illuminate\Http\Request;

class PersetujuanCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:daftar.persetujuancuti', ['only' => ['index']]);
        $this->middleware('permission:create.persetujuancuti', ['only' => ['store']]);
        $this->middleware('permission:view.persetujuancuti', ['only' => ['show']]);
        $this->middleware('permission:edit.persetujuancuti', ['only' => ['edit', 'updateReject', 'updateApprove']]);
        $this->middleware('permission:delete.persetujuancuti', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get data persetujuan cuti
        $persetujuan = PersetujuanCuti::with('pengajuanCuti')->get();
        // dd($persetujuan);
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
        //get data pengajuan cuti, get user that have role manajer, and tembusan
        $persetujuan = PersetujuanCuti::with('pengajuanCuti')->findOrFail($persetujuan->id);
        $manajer = User::whereHas('jabatan', function ($query) {
            $query->where('nama_jabatan', 'GENERAL MANAGER');
        })->get();
        $tembusan = Tembusan::where('persetujuan_cuti_id', $persetujuan->id)->get();
        return view('cuti.persetujuan.suratIzinCuti', compact('persetujuan', 'manajer', 'tembusan'));
        // dd($tembusan);
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

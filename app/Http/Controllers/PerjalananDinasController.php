<?php

namespace App\Http\Controllers;

use App\Models\PerjalananDinas;
use App\Models\User;
use App\Notifications\NotifPenugasanDinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PerjalananDinasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get data penugasan with pegawai and pengikut
        $penugasan = PerjalananDinas::with('user', 'pengikut')->get();
        return view('perjalanandinas.index', compact('penugasan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function penugasan($id)
    {
        //find user by id
        $pegawai = User::with('pegawai')->find($id);
        return response()->json([
            'status' => 200,
            'pegawai' => $pegawai,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //request user by id
        $pegawai_id = $request->user_id;
        $pengikut_id = $request->pengikut;

        //if pengikut is null
        if ($pengikut_id == null) {
            $penugasan = PerjalananDinas::create([
                'user_id' => $pegawai_id,
                'status' => 'pending',
            ]);
            $penugasan->save();
        } else {
            //if pengikut is not null
            $penugasan = PerjalananDinas::create([
                'user_id' => $pegawai_id,
                'pengikut' => $pengikut_id,
                'status' => 'pending',
            ]);
            $penugasan->save();
        }
        //get user that send notification
        $pegawai = User::whereHas('pegawai', function ($query) use ($pegawai_id) {
            $query->where('user_id', $pegawai_id);
        })->orwhereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();

        //send notification to user
        Notification::send($pegawai, new NotifPenugasanDinas($penugasan));

        return redirect('/perjalanan-dinas')->with('success', 'Data berhasil ditambahkan');
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

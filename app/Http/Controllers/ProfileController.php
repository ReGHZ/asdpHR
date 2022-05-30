<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
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
        $pegawai = Auth::user();
        return view('usermanagement.profile', compact('pegawai', 'divisi', 'jabatan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

        $user = User::with('pegawai')->find(Auth::id());;

        return response()->json([
            'status' => 200,
            'user' => $user,
        ]);
    }
}

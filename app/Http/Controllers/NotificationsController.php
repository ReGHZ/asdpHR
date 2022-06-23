<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function markNotif($id)
    {
        //if get id auth user mark notif
        if ($id) {

            auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function markAll()
    {
        //mark all auth user notif
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function markAsRead($noti)
    {
        foreach (auth()->user()->notifications as $notification) {
            if ($noti == $notification->id) {
                $notification->markAsRead();
            }
        }
        return redirect()->back();
    }
}

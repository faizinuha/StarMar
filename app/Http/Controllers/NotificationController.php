<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class NotificationController extends Controller
{
    public function index()
    {
        // Mendapatkan semua notifikasi pengguna yang belum dibaca
        $notifications = Auth::user()->unreadNotifications;

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead()
    {
        // Tandai semua notifikasi sebagai dibaca
        Auth::user()->unreadNotifications->markAsRead();

        return redirect()->back()->with('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }
}

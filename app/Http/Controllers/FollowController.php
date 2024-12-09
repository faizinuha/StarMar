<?php

namespace App\Http\Controllers;

use App\Notifications\NewFollowerNotification;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    /**
     * Follow a user.
     */
    public function follow(User $user)
    {
        $currentUser = Auth::user();

        // Cek apakah pengguna sudah mengikuti
        if (!$currentUser->followings->contains($user->id)) {
            // Follow pengguna
            $currentUser->followings()->attach($user->id);

            // Kirim notifikasi ke pengguna yang diikuti
            $user->notify(new NewFollowerNotification($currentUser)); // Kirim notifikasi
        }

        return redirect()->back()->with('success', 'Berhasil mengikuti pengguna.');
    }

    /**
     * Unfollow a user.
     */
    public function unfollow(User $user)
    {
        $currentUser = Auth::user();

        // Cek apakah pengguna sudah mengikuti
        if ($currentUser->followings()->where('following_id', $user->id)->exists()) {
            // Unfollow pengguna
            $currentUser->followings()->detach($user->id);
            
            return redirect()->back()->with('success', 'Berhasil berhenti mengikuti pengguna.');
        }

        return redirect()->back()->with('info', 'Anda belum mengikuti pengguna ini.');
    }

    // Fungsi lainnya yang tidak digunakan dapat dihapus atau tetap dibiarkan kosong.
}

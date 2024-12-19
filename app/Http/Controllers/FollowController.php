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
    
        if (!$currentUser->followings->contains($user->id)) {
            $currentUser->followings()->attach($user->id);
    
            // Kirim notifikasi (opsional)
            $user->notify(new NewFollowerNotification($currentUser));
        }
    
        return redirect()->back()->with('success', 'Berhasil mengikuti pengguna.');
    }
    

    /**
     * Unfollow a user.
     */
    public function unfollow(User $user)
    {
        $currentUser = Auth::user();
    
        if ($currentUser->followings->where('following_id', $user->id)->exists()) {
            $currentUser->followings()->detach($user->id);
        }
    
        return redirect()->back()->with('success', 'Berhasil berhenti mengikuti pengguna.');
    }
    

    // Fungsi lainnya yang tidak digunakan dapat dihapus atau tetap dibiarkan kosong.
    public function deleteFriend(User $user)
    {
        $currentUser = Auth::user();
    
        // Hapus pengguna dari daftar teman (menghapus hubungan)
        if ($currentUser->followings()->where('following_id', $user->id)->exists()) {
            $currentUser->followings()->detach($user->id);
        }
    
        return redirect()->back()->with('success', 'Berhasil menghapus teman.');
    }
    
}

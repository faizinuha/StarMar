<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Follow;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function users($id): View
    {
        $user = User::findOrFail($id); // Ambil data pengguna berdasarkan ID
        $followersCount = $user->followers()->count();
        $followingCount = $user->followings()->count();

        // Mengambil semua post milik pengguna
        $posts = Post::where('user_id', $user->id)->get();

        // Menghitung jumlah post
        $postCount = $posts->count();

        return view('users.setting.profile.user-profile', 
            compact('user', 'posts', 'postCount', 'followersCount', 'followingCount'));
    }

    public function profile()
    {
        $user = Auth::user();

        // Gunakan foto default jika pengguna belum memiliki foto profil
        $profilePhoto = $user->photo_profile ?: $this->getDefaultProfilePicture();

        $followersCount = $user->followers()->count();
        $followingCount = $user->followings()->count();
        $posts = Post::where('user_id', $user->id)->get();
        $postCount = $posts->count();
        $pos = Post::with('user')
            ->where('user_id', $user->id)
            ->select('image', 'video', 'video_short', 'filter', 'crop', 'content')
            ->get();

        return view('users.setting.profile.user-profile', 
            compact('followersCount', 'postCount', 'pos', 'followingCount', 'posts', 'user', 'profilePhoto'));
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $firstName = strtolower($user->first_name); // Menggunakan first_name sebagai nama folder
        $folderPath = "uploads/{$firstName}/";

        // Jika sebelumnya sudah ada foto, hapus (kecuali foto default)
        if ($user->photo_profile && $user->photo_profile !== $this->getDefaultProfilePicture()) {
            Storage::delete("public/{$user->photo_profile}");
        }

        // Simpan gambar baru
        $path = $request->file('photo')->store($folderPath, 'public');
        $user->photo_profile = $path;
        $user->save();

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function getDefaultProfilePicture()
    {
        return 'users/Avatar.png'; // Path foto profil default
    }

    public function showcontent()
    {
        $user = Auth::user();
        $pos = Post::with('user')
            ->where('user_id', $user->id)
            ->select('image', 'video', 'video_short', 'filter', 'crop', 'content')
            ->get();
        return view('users.setting.profile.user-profile', compact('pos'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

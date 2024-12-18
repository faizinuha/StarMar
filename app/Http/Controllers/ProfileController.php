<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\models\user;
use App\models\Follow;
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


    // ProfileController.phppublic function users($id): View
    public function users($id): View
    {
        $user = User::findOrFail($id); // Ambil data pengguna berdasarkan ID
        $followersCount = $user->followers()->count();
        $followingCount = $user->followings()->count();
    
        // Mengambil semua post milik pengguna
        $posts = Post::where('user_id', $user->id)->get(); // Ambil post berdasarkan user_id
    
        // Menghitung jumlah post yang dimiliki oleh pengguna
        $postCount = $posts->count(); // Menghitung jumlah post
    
        return view('users.setting.profile.user-profile',
        compact('user', 'posts','postCount','followersCount','followingCount'));
    }

    public function profile()
    {
        $user = Auth::user(); // Ambil pengguna yang sedang login
    
        // Mengambil jumlah followers dan following
        $followersCount = $user->followers()->count();
        $followingCount = $user->followings()->count();
    
        // Mengambil semua post milik pengguna
        $posts = Post::where('user_id', $user->id)->get(); // Ambil post berdasarkan user_id
    
        // Menghitung jumlah post yang dimiliki oleh pengguna
        $postCount = $posts->count(); // Menghitung jumlah post
        $pos = Post::with('user')
        ->where('user_id', $user->id)
        ->select('image', 'video', 'video_short', 'filter', 'crop', 'content')
        ->get();
    
        return view('users.setting.profile.user-profile', 
        compact('followersCount', 'postCount','pos', 'followingCount', 'posts', 'user'));
    }
    // use Illuminate\Support\Facades\Storage;

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $user = Auth::user();
        $username = $user->name;
    
        // Buat folder berdasarkan nama user
        $folderPath = "uploads/{$username}/";
    
        // Jika sebelumnya sudah ada foto, hapus
        if ($user->photo_profile && $user->photo_profile !== 'placeholder.png') {
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
        return 'https://via.placeholder.com/150'; // Foto profil default dari internet
    }
    

    public function showcontent(){
                $user = Auth::user(); // Ambil pengguna yang sedang login
        $pos = Post::with('user')
        ->where('user_id', $user->id)
        ->select('image', 'video', 'video_short', 'filter', 'crop', 'content')
        ->get();
        return view('users.setting.profile.user-profile');
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

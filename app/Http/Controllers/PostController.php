<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Hashtag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
// use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
// use Intervention\Image\Facades\Image;
use Intervention\Image\Facades\Image;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class PostController extends Controller
{
    // Menampilkan semua postingan
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        // dd(Post::latest()->first());
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    // Menyimpan postingan baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'content' => 'required|string|max:255',
            'video' => 'nullable|file|mimes:mp4,avi,mkv,webm|max:102400', // Validasi tipe dan ukuran file video
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:99999999',
            'hashtags' => 'nullable|string|max:255',
            'filter' => 'nullable|string|max:255',
            'crop' => 'nullable|string|max:255',
        ]);
    
        // Proses penyimpanan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('Postingan', 'public');
        }
    
        // Proses penyimpanan video jika ada
        $videoPath = null;
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public');
        }
    
        // Menyimpan filter dan crop
        $filter = $request->filter;
        $crop = $request->crop;
    
        // Membuat postingan baru
        $post = Post::create([
            'user_id' => Auth::id(),
            'video' => $videoPath,
            'image' => $imagePath,
            'content' => $request->content,
            'filter' => $filter,
            'crop' => $crop,
        ]);
    
        // Menyimpan hashtag
        if ($request->hashtags) {
            $hashtags = explode(',', $request->hashtags);
            foreach ($hashtags as $tag) {
                $tag = Str::slug(trim($tag), '-');
                $hashtag = Hashtag::firstOrCreate(
                    ['name' => $tag],
                    ['user_id' => Auth::id()]
                );
                $post->hashtags()->attach($hashtag->id);
            }
        }
    
        return redirect()->route('beranda')->with('success', 'Post berhasil ditambahkan!');
    }
    
    
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'content' => 'required|string|max:255',
            'video' => 'nullable|file|mimes:mp4,avi,mkv,webm|max:102400', // Validasi tipe dan ukuran file video
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'filter' => 'nullable|string|max:255',
            'crop' => 'nullable|string|max:255',
            'hashtags' => 'nullable|string|max:255',
        ]);
    
        // Mendapatkan postingan yang akan diupdate
        $post = Post::findOrFail($id);
    
        // Proses penyimpanan gambar baru jika ada
        $imagePath = $post->image; // Gunakan gambar lama jika tidak ada gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($imagePath && Storage::exists('public/' . $imagePath)) {
                Storage::delete('public/' . $imagePath);
            }
            // Simpan gambar baru ke folder 'img' di storage
            $imagePath = $request->file('image')->store('img', 'public');
        }
    
        // Proses penyimpanan video baru jika ada
        $videoPath = $post->video; // Gunakan video lama jika tidak ada video baru
        if ($request->hasFile('video')) {
            // Hapus video lama jika ada
            if ($videoPath && Storage::exists('public/' . $videoPath)) {
                Storage::delete('public/' . $videoPath);
            }
            // Simpan video baru
            $videoPath = $request->file('video')->store('videos', 'public');
        }
    
        // Menyimpan filter dan crop
        $filter = $request->filter ?? $post->filter;
        $crop = $request->crop ?? $post->crop;
    
        // Update postingan
        $post->update([
            'video' => $videoPath,
            'image' => $imagePath,
            'content' => $request->content,
            'filter' => $filter,
            'crop' => $crop,
        ]);
    
        // Proses Hashtag
        if ($request->hashtags) {
            $hashtags = explode(',', $request->hashtags);
            $post->hashtags()->detach(); // Hapus hashtag lama
            foreach ($hashtags as $tag) {
                $tag = Str::slug(trim($tag), '-'); // Normalisasi
                $hashtag = Hashtag::firstOrCreate(
                    ['name' => $tag],
                    ['user_id' => Auth::id()]
                );
                $post->hashtags()->attach($hashtag->id);
            }
        }
    
        return redirect()->route('beranda')->with('success', 'Post berhasil diperbarui!');
    }
    
    


    // Menghapus postingan
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Hapus gambar jika ada
        if ($post->image && Storage::exists('public/' . $post->image)) {
            Storage::delete('public/' . $post->image);
        }

        // Hapus postingan dari database
        $post->delete();

        return redirect()->route('beranda')->with('success', 'Post berhasil dihapus!');
    }
    public function likePost(Request $request)
    {
        $post = Post::find($request->post_id);
        $user = Auth::user();

        if (!$post || !$user) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        // Cek apakah user sudah menyukai postingan
        if ($post->likedByUsers()->where('user_id', $user->id)->exists()) {
            $post->likedByUsers()->detach($user->id); // Hapus like
            return response()->json(['status' => 'unliked']);
        } else {
            $post->likedByUsers()->attach($user->id); // Tambahkan like
            return response()->json(['status' => 'liked']);
        }
    }
}
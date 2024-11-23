<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Hashtag;
use Illuminate\Support\Str;

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
            'video' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
            'hashtags' => 'nullable|string|max:255',
        ]);

        // Proses penyimpanan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Menyimpan gambar ke folder 'img' di storage
            $imagePath = $request->file('image')->store('img', 'public');
        }

        // Proses penyimpanan video jika ada
        $videoPath = null;
        if ($request->has('video')) {
            $videoPath = $request->video;
        }

        // Membuat postingan baru
        $post = Post::create([
            'user_id' => Auth::id(),
            'video' => $videoPath,
            'image' => $imagePath,
            'content' => $request->content,
        ]);

        // Proses Hashtag
        if ($request->hashtags) {
            $hashtags = explode(',', $request->hashtags); // Misal: "wallpapers,art"
            foreach ($hashtags as $tag) {
                $tag = Str::slug(trim($tag), '-'); // Normalisasi
                $hashtag = Hashtag::firstOrCreate(
                    ['name' => $tag],
                    ['user_id' => Auth::id()]
                );
                $post->hashtags()->attach($hashtag->id);
            }
        }

        return redirect()->route('posts.index')->with('success', 'Post berhasil ditambahkan!');
    }


    // Menampilkan halaman edit (opsional)
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    // Mengupdate postingan
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'content' => 'required|string|max:255',
            'video' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
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
            $imagePath = $request->file('public')->store('img', 'public');
        }

        // Proses penyimpanan video jika ada
        $videoPath = $post->video; // Gunakan video lama jika tidak ada video baru
        if ($request->has('video')) {
            $videoPath = $request->video;
        }

        // Update postingan
        $post->update([
            'video' => $videoPath,
            'image' => $imagePath, // Menyimpan path gambar baru
            'content' => $request->content,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post berhasil diperbarui!');
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

        return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Story;
use App\Models\User;
use Illuminate\Support\Facades\Cache;


class berandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function index()
     {
         // Ambil data posts terbaru beserta komentar, replies, dan user
         $posts = Post::with(['comments.replies.user', 'comments.user'])
             ->orderBy('created_at', 'desc')
             ->get();
     
         // Ambil data stories yang belum kedaluwarsa beserta user
         $stories = Story::where('expires_at', '>', now())
             ->with('user')
             ->latest()
             ->get();
     
         $groupedStories = $stories->groupBy('user_id');
     
         return view('users.view.beranda', compact('posts', 'stories', 'groupedStories'));
     }


    /**
     * Fungsi untuk memeriksa apakah error terkait jaringan/koneksi.
     */
    private function isNetworkError($e)
    {
        // Anda dapat memeriksa pesan atau kode error spesifik
        return str_contains($e->getMessage(), 'SQLSTATE') || str_contains($e->getMessage(), 'Connection refused');
    }


    public function setting()
    {
        $user = User::all();
        return view('users.setting.default-setting', compact('user'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with(['comments.replies', 'comments.user'])->get(); // Include nested relations
        $user = User::all();
    
        if ($post->isEmpty() || $user->isEmpty()) {
            return redirect()->back()->with('error', 'No posts or users found.');
        }
    
        return view('home.showdetail', compact('post', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
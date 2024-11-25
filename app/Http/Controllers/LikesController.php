<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

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
            return response()->json([
                'status' => 'unliked',
                'like_count' => $post->likedByUsers()->count(),
            ]);
        } else {
            $post->likedByUsers()->attach($user->id); // Tambahkan like
            return response()->json([
                'status' => 'liked',
                'like_count' => $post->likedByUsers()->count(),
            ]);
        }
    }





    public function index()
    {
        //
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
    public function show(Likes $likes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Likes $likes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Likes $likes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Likes $likes)
    {
        //
    }
}
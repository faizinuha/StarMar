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
}
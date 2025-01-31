<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ExplorerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $posts = Post::whereNotNull('image')
            ->orWhereNotNull('video')
            ->latest()
            ->get();

        return view('users.view.explorer', compact('posts', 'users'));
    }

    // app/Http/Controllers/ExplorerController.php
    public function showAllUsers()
    {
        $users = User::all(); // Mengambil semua pengguna
        $posts = Post::whereNotNull('image')
            ->orWhereNotNull('video')
            ->latest()
            ->get(); // Mengambil semua post yang memiliki gambar atau video
    
        return view('users.view.SeeAllUsers', compact('users', 'posts'));
    }


    public function show(Request $request) //search
    {
        $query = $request->input('q');

        $users = [];
        $posts = Post::query();

        if ($query) {
            $users = User::where('first_name', 'LIKE', "%{$query}%")
                ->orWhere('last_name', 'LIKE', "%{$query}%")
                ->select('id', 'first_name', 'last_name', 'photo_profile')
                ->get();

            $posts = $posts->where('content', 'LIKE', "%{$query}%");
        }

        $posts = $posts->whereNotNull('image')
            ->orWhereNotNull('video')
            ->latest()
            ->get();

        return view('users.view.explorer', compact('users', 'posts', 'query'));
    }
}

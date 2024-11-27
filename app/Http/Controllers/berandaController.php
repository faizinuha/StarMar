<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Cache;


class berandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        // Cache query posts selama 10 menit
        $posts = Cache::remember('posts', 600, function () {
            return Post::with(['comments.replies', 'comments.user'])->get();
        });

        $users = Cache::remember('users', 600, function () {
            return User::all();
        });

        return view('home.beranda', compact('posts', 'users'));
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

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
        try {
            // Ambil data posts terbaru beserta komentar dan reply-nya
            $posts = Post::with(['comments.replies', 'comments.user'])
                ->orderBy('created_at', 'desc')
                ->get();

            // Cek apakah koneksi ke tabel users bermasalah
            $users = User::all();
        } catch (\Exception $e) {
            // Redirect ke halaman 404 jika terjadi error
            return view('errors.404');
        }

        return view('users.view.beranda', compact('posts', 'users'));
    }


    public function setting()
    {
        return view('users.setting.default-setting');
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

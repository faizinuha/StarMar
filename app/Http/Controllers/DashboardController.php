<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::all()->count();
        $user = User::all()->count();
        // Kirim data ke view dashboard
        return view('dashboard', compact('posts', 'user'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::all()->count();
        $user = User::all()->count();

        $maleCount = User::where('gender', 'male')->count();
        $femaleCount = User::where('gender', 'female')->count();

        $postsPerMonth = [];
        for ($month = 7; $month <= 12; $month++) {
            $postsPerMonth[] = Post::whereMonth('created_at', $month)
                ->whereYear('created_at', Carbon::now()->year)  // Mengambil tahun saat ini
                ->count();
        }


        $months = ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        return view('dashboard', compact('posts', 'user', 'maleCount', 'femaleCount', 'postsPerMonth', 'months'));
    }
}

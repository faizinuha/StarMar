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
    $totalPosts = Post::count(); // Total number of posts
    $totalUsers = User::count(); // Total number of users

    // Data for charts (assuming these are already calculated in your controller)
    $maleCount = User::where('gender', 'male')->count();
    $femaleCount = User::where('gender', 'female')->count();
    $postsPerMonth = Post::selectRaw('MONTH(created_at) as month, count(*) as count')
                         ->groupBy('month')
                         ->pluck('count', 'month')->toArray();
    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    return view('admin.dashboard', compact('totalPosts', 'totalUsers', 'maleCount', 'femaleCount', 'postsPerMonth', 'months'));
}

}

<?php

use App\Http\Controllers\berandaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HashtagController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [BerandaController::class, 'index'])->name('beranda');
// Autentikasi Laravel Breeze
require __DIR__ . '/auth.php';
// Rute untuk halaman utama feed
Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
// Rute untuk menampilkan halaman form create (GET)
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
// Rute untuk menyimpan postingan baru (POST)
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
// Route yang sudah ada
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');

use App\Models\Post;
use App\Models\user;
Route::get('/dashboard', function () {
    // Ambil semua data postingan dari tabel posts
    $posts = Post::all()->count();
    $user = User::all()->count();
    // Kirim data ke view dashboard
    return view('dashboard', compact('posts','user'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Route untuk Profile
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/hashtags/suggest', [HashtagController::class, 'suggest'])->name('hashtags.suggest');

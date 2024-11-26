<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HashtagController;
use App\Http\Controllers\LikesController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/* ============================
|  BERANDA
============================= */

Route::get('/', [BerandaController::class, 'index'])->name('beranda')->middleware('auth');

/* ============================
|  AUTENTIKASI (Laravel Breeze)
============================= */
require __DIR__ . '/auth.php';

/* ============================
|  POSTINGAN
============================= */
// Rute untuk halaman utama feed
Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
// Rute untuk halaman utama feed (index)
Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');

// Rute untuk menampilkan halaman form create (GET)
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');

// Rute untuk menyimpan postingan baru (POST)
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');

// Rute untuk menampilkan form edit (GET)
Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');

// Rute untuk update postingan (PUT/PATCH)
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update')->middleware('auth');

// Rute untuk menghapus postingan (DELETE)
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');

/* ============================
|  LIKE
============================= */
// Rute untuk menyukai postingan
Route::post('/like', [LikesController::class, 'likePost'])->name('post.like');

/* ============================
|  DASHBOARD
============================= */
Route::get('/dashboard', function () {
    // Ambil jumlah total data dari tabel posts dan user
    $posts = Post::all()->count();
    $user = User::all()->count();
    // Kirim data ke view dashboard
    return view('dashboard', compact('posts', 'user'));
})->middleware(['auth', 'verified'])->name('dashboard');

/* ============================
|  PROFILE
============================= */
Route::middleware(['auth', 'verified'])->group(function () {
    // Rute untuk menampilkan halaman edit profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Rute untuk memperbarui profil (PATCH)
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Rute untuk menghapus profil (DELETE)
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* ============================
|  HASHTAGS
============================= */
// Rute untuk mendapatkan saran hashtag
Route::get('/hashtags/suggest', [HashtagController::class, 'suggest'])->name('hashtags.suggest');

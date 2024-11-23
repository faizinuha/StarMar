<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Autentikasi Laravel Breeze
require __DIR__.'/auth.php';
// Rute untuk halaman utama feed
Route::get('/', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
// Rute untuk menampilkan halaman form create (GET)
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
// Rute untuk menyimpan postingan baru (POST)
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
// Route yang sudah ada
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');

// Dashboard (default dari Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route untuk Profile
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HashtagController;
use App\Http\Controllers\LikesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/* ============================
|  UMUM (GENERAL)
============================= */

// Rute untuk autentikasi (Laravel Breeze)
require __DIR__ . '/auth.php';
Route::get('/', [BerandaController::class, 'index'])->name('beranda')->middleware('auth.session');
// Rute untuk menyukai postingan
Route::post('/like', [LikesController::class, 'likePost'])->name('post.like');
// Rute untuk manajemen komentar
Route::resource('comments', CommentController::class);
// Rute untuk mendapatkan saran hashtag
Route::get('/hashtags/suggest', [HashtagController::class, 'suggest'])->name('hashtags.suggest');

/* ============================
|  KHUSUS USERS
============================= */
Route::middleware(['auth','verified'])->group(function () {
    // Halaman Beranda

    // Manajemen Postingan
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('posts.index');
        Route::get('/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/', [PostController::class, 'store'])->name('posts.store');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/{id}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    });
    // Manajemen Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Halaman Akun
});

/* ============================
|  KHUSUS ADMIN
============================= */
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Halaman Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/Account', [AccountController::class, 'index'])->name('Account.index');
    Route::get('/Account/export-pdf', [AccountController::class, 'exportPdf'])->name('Account.exportPdf');

});

<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HashtagController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\NotificationController;
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
Route::middleware('auth')->group(function () {
    Route::get('/', [BerandaController::class, 'index'])->name('beranda');
    Route::post('/like', [LikesController::class, 'likePost'])->name('post.like');
    Route::resource('comments', CommentController::class);
    Route::post('/follow/{user}', [FollowController::class, 'follow'])->name('follow');
    Route::delete('/unfollow/{user}', [FollowController::class, 'unfollow'])->name('unfollow');
    Route::delete('/friend/{user}', [FollowController::class, 'deleteFriend'])->name('delete.friend');
    Route::get('/hashtags/suggest', [HashtagController::class, 'suggest'])->name('hashtags.suggest');
});
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

/* ============================
|  KHUSUS USERS
============================= */
Route::middleware(['auth',])->group(function () {
    // Halaman Beranda
    // Manajemen Postingan
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('posts.index');
        Route::get('/uploads', [PostController::class, 'create'])->name('posts.create');
        Route::post('/', [PostController::class, 'store'])->name('posts.store');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/{id}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    });
    Route::get('/user-setting', [berandaController::class, 'setting'])->name('user.setting');
    // Manajemen Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user-profile/{id}', [ProfileController::class, 'users'])->name('user.profile');
    Route::post('/profile/update-picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.update_picture');
    Route::get('Profile', [ProfileController::class, 'profile'])->name('profile');
    // Halaman Akun
});

/* ============================
|  KHUSUS ADMIN
============================= */
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Halaman Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/Account', [AccountController::class, 'index'])->name('Account.index');
});

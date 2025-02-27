<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController,
App\Http\Controllers\BerandaController,
App\Http\Controllers\CommentController,
App\Http\Controllers\DashboardController,
App\Http\Controllers\PostController,
App\Http\Controllers\ProfileController,
App\Http\Controllers\HashtagController,
App\Http\Controllers\LikesController,
App\Http\Controllers\FollowController,
App\Http\Controllers\ReportController,
App\Http\Controllers\NotificationController,
App\Http\Controllers\AdminController,
App\Http\Controllers\ExplorerController,
App\Http\Controllers\StoryController,
App\Http\Controllers\AiGeminiController;
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
Route::middleware(['auth'])->group(function () {
    Route::get('/', [BerandaController::class, 'index'])->name('beranda');
    Route::post('/like', [LikesController::class, 'likePost'])->name('post.like');
    Route::resource('comments', CommentController::class);
    Route::post('/follow/{user}', [FollowController::class, 'follow'])->name('follow');
    Route::delete('/unfollow/{user}', [FollowController::class, 'unfollow'])->name('unfollow');
    Route::delete('/friend/{user}', [FollowController::class, 'deleteFriend'])->name('delete.friend');
    Route::get('/hashtags/suggest', [HashtagController::class, 'suggest'])->name('hashtags.suggest');

    // Gemini
    Route::get('/Ai-Gemini', [AiGeminiController::class, 'index'])->name('ai-gemini.index');
    Route::post('/Ai-Gemini/chat', [AiGeminiController::class, 'chat'])->name('ai-gemini.chat');
});

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

/* ============================
|  KHUSUS USERS
============================= */
Route::middleware(['auth',])->group(function () {
    // Halaman Beranda && pow 
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('posts.index');
        Route::get('/uploads', [PostController::class, 'create'])->name('posts.create');
        Route::post('/', [PostController::class, 'store'])->name('posts.store');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/{id}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    });
    Route::get('/Pengaturan', [berandaController::class, 'setting'])->name('user.setting');
    // Manajemen Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::get('/profile.php/{id]]}', [ProfileController::class, 'users'])->name('user.profile');
    Route::get('/profile.php/{id}', [ProfileController::class, 'users'])->name('user.profile');
    Route::post('/profile/update-picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.update_picture');
    Route::get('Profile.php/', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/profile/about', [ProfileController::class, 'about'])->name('profile.about');
    Route::get('/profile/membership', [ProfileController::class, 'membership'])->name('profile.membership');

    // Halaman Akun && stories and report and explorer
    // routes/web.php
    Route::get('/explorer/Seeusers', [ExplorerController::class, 'showAllUsers'])->name('explorer.showAllUsers');
    Route::get('/explorer/search', [ExplorerController::class, 'show'])->name('explorer.search');
    Route::get('/explorer', [ExplorerController::class, 'index'])->name('explorer.index');
    Route::post('/stories', [StoryController::class, 'store'])->name('stories.store');
    Route::get('/stories/{id}', [StoryController::class, 'show'])->name('stories.show');

    Route::get('/report/{type}/{id}', [ReportController::class, 'create'])->name('report.create');
    Route::post('/report', [ReportController::class, 'store'])->name('report.store');
    Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
});

/* ============================
|  KHUSUS ADMIN
============================= */
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Halaman Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/Account', [AccountController::class, 'index'])->name('Account.index');
    Route::post('reports/{report}/action', [AdminController::class, 'takeAction'])->name('admin.reports.action');
    Route::get('reports/{report}/action', [AdminController::class, 'actionPage'])->name('admin.reports.actionPage');
});

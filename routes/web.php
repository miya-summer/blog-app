<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FrontendPostController;

// --- 公開ページ（将来的にここを広げていく） ---
Route::get('/', [FrontendPostController::class, 'index'])->name('home');
Route::get('/posts/{post}', [FrontendPostController::class, 'show'])->name('posts.show');

// --- 管理画面（/admin プレフィックス配下） ---
Route::middleware(['auth', 'verified'])->prefix('admin')->as('admin.')->group(function () {
    
    // Dashboard: URLは /admin/dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile: URLは /admin/profile/...
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 各リソース: URLは /admin/posts や /admin/categories
    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostController::class);
});

require __DIR__.'/auth.php';

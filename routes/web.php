<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FrontendPostController;

// --- 公開ページ（将来的にここを広げていく） ---
Route::get('/', [FrontendPostController::class, 'index'])->name('home');

// カテゴリー絞り込み: /categories/1
Route::get('/categories/{category:slug}', [FrontendPostController::class, 'categoryIndex'])->name('posts.category');

// 月別アーカイブ: /archive/2026/05
// 年(year)と月(month)を分けて受け取る設計にします
Route::get('/archive/{year}/{month}', [FrontendPostController::class, 'archiveIndex'])
    ->where(['year' => '[0-9]{4}', 'month' => '[0-1][0-9]']) // バリデーション（数字のみ）
    ->name('posts.archive');

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

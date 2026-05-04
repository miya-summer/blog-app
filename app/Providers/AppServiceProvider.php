<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any:q
     * 
     * 
     * 
     * 
     *  application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 'components.sidebar' が読み込まれる時に実行する
        View::composer('components.sidebar', function ($view) {
            
            // 1. カテゴリー一覧（記事数付き、記事があるものだけ）
            $sideCategories = Category::withCount('posts')
                ->has('posts')
                ->orderBy('posts_count', 'desc')
                ->get();

            // 2. 月別アーカイブの集計
            $monthList = Post::query()
                ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') AS `year_month`")
                ->selectRaw("COUNT(*) AS `post_count`")
                ->groupByRaw("`year_month` ") // SQLで成功した通りバッククォートで囲む
                ->orderByRaw("`year_month` DESC")
                ->get();

            // ビューに変数を渡す
            $view->with(compact('sideCategories', 'monthList'));
        });
    }
}

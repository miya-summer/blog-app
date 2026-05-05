<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendPostController extends Controller
{
    public function index()
    {
        // 1. データベースから記事を取得する
        $posts = Post::latest()->paginate(10);

        // 2. ビルドした変数を view に渡す
        return view('frontend.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        // ルートモデルバインディングにより、$post には自動的に該当記事が入ります
        return view('frontend.posts.show', compact('post'));
    }

    // カテゴリー絞り込み
    public function categoryIndex(Category $category)
    {
        $posts = $category->posts()
                ->latest() // 最新順
                ->paginate(10);

        // 同じViewを指定し、$title だけその場に合わせる
        return view('frontend.posts.index', [
            'posts' => $posts,
            'title' => "カテゴリー：{$category->name}"
        ]);
    }

    // 月別アーカイブ
    public function archiveIndex($year, $month)
    {
        $posts = Post::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->latest()
                ->paginate(10);

        return view('frontend.posts.index', [
            'posts' => $posts,
            'title' => "アーカイブ: {$year}年{$month}月"
        ]);
    }
}

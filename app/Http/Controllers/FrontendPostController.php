<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FrontendPostController extends Controller
{
    public function index()
    {
        // 1. データベースから記事を取得する
        $posts = Post::all(); 

        // 2. ビルドした変数を view に渡す
        return view('frontend.posts.index', compact('posts'));
    }
}

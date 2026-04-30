<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 記事を新しい順に取得。カテゴリも一緒に読み込む（Eager Load）
        $posts = Post::with('categories')->latest()->get();

        // posts/index.blade.php を表示する
        return view('posts.index', compact('posts'));
    }

    /**
     * 記事投稿画面を表示
     */
    public function create()
    {
        // チェックボックスに出すために全カテゴリを取得
        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

/**
     * 2. 投稿内容をDBに保存する
     */
    public function store(Request $request)
    {
        // バリデーション（入力チェック）
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'categories' => 'array', // カテゴリは配列で送られてくる
        ]);

        // ① 記事本体を保存
        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'body' => $request->body,
        ]);

        // ② 中間テーブルにカテゴリを紐付ける
        // attachメソッドに配列 [1, 2] を渡すと、中間テーブルに一気に保存される
        if ($request->has('categories')) {
            $post->categories()->attach($request->categories);
        }

        // 保存が終わったら、一旦投稿画面に戻る（またはメッセージを出す）
        return redirect()->route('posts.create')->with('message', '記事を保存しました！');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}

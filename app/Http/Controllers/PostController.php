<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * 記事一覧を表示
     */
    public function index()
    {
        // 記事を新しい順に取得。カテゴリも一緒に読み込む（Eager Load）
        $posts = Post::with('categories')->latest()->get();

        // posts/index.blade.php を表示する
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * 記事投稿画面を表示
     */
    public function create()
    {
        // チェックボックスに出すために全カテゴリを取得
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * 投稿内容を保存
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
        return redirect()->route('admin.posts.create')->with('message', '記事を保存しました！');
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
        // 全カテゴリを取得（チェックボックス用）
        $categories = Category::all();

        // posts/edit.blade.php を表示（現在の記事データとカテゴリを渡す）
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'categories' => 'array',
        ]);

        // 記事本体を更新
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        // 中間テーブルを同期（これだけで追加・削除を自動判別！）
        $post->categories()->sync($request->categories ?? []);

        return redirect()->route('admin.posts.index')->with('message', '記事を更新しました！');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete(); // 中間テーブルの紐付けは、MigrationでonDelete('cascade')していれば自動で消えます
        return redirect()->route('admin.posts.index')->with('message', '記事を削除しました');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;

class OldPostController extends Controller
{
    public function destroy(Request $request, Post $post)
    {
        $post->delete();
        $request->session()->flash('message', '削除しました');
        return redirect('post');
    }
    public function update(Request $request, Post $post)
    {
   //    Gate::authorize('test');

    $validated = $request->validate([
        'title' => 'required|max:20',
        'body'  => 'required|max:400'
    ]);

    // ログインユーザーのIDをセット
    $validated['user_id'] = Auth::id();

    // 
    // ここで1回だけ update() する
        $post->update($validated);

    $request->session()->flash('message', '保存しました');
    return back();
    }

    public function edit(Post $post)
    {
        // 他のユーザーの投稿を編集できないようにする
        // Gate::authorize('update', $post);    // copirot推薦

        return view('posts.edit', compact('post'));
    }

    public function show(Post $post)
    {
        // 他のユーザーの投稿を見れないようにする
        // Gate::authorize('view', $post);

        return view('posts.show', compact('post'));
    }

    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->get();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {

    //    Gate::authorize('test');

    $validated = $request->validate([
        'title' => 'required|max:20',
        'body'  => 'required|max:400'
    ]);

    // ログインユーザーのIDをセット
    $validated['user_id'] = Auth::id();

    // ここで1回だけ create() する
    Post::create($validated);

    $request->session()->flash('message', '保存しました');

    // POST-Redirect-GET で二重送信防止
    // return redirect()->route('post.index');
    return back();
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function add()
    {
        return view('posts.add');
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = Str::slug($request->title);
        if($request->thumbnail)
        {
            $data['thumbnail'] = $request->file('thumbnail')->store('assets/posts','public');
        }
        Post::create($data);
        return redirect('/posts')->with('sukses','Post berhasil di tambah');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        if($request->thumbnail)
        {
            $data['thumbnail'] = $request->file('thumbnail')->store('assets/posts','public');
        }
        $item = Post::find($id);
        $item->update($data);
        return redirect('/posts')->with('sukses','Post berhasil di update');
    }

    public function delete($id)
    {
        $item = Post::find($id);
        $item->delete();
        return redirect('/posts')->with('sukses','Post berhasil di delete');
    }
}

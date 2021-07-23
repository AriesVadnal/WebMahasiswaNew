<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Forum;
use App\Komentar;
use Auth;

class ForumController extends Controller
{
    public function index()
    {
        $forum = Forum::paginate(10);
        return view('forum.index', compact('forum'));
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = Str::slug($request->judul);
        Forum::create($data);
        return redirect('/forum')->with('sukses','Forum Berhasil di Tambah');
    }

    public function view(Forum $forum)
    {
        return view('forum.view', compact('forum'));
    }

    public function postkomentar(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        Komentar::create($data);
        return redirect()->back()->with('sukses','Komentar berhasil di tambah');
    }
}

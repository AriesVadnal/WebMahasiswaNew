<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\NotifPendaftaranSiswa;
use App\Siswa;
use App\User;
use App\Post;

class SiteController extends Controller
{
    public function home()
    {
        $posts = Post::all();
        return view('sites.home', compact('posts'));
    }

    public function register()
    {
        return view('sites.register');
    }

    public function postregister(Request $request)
    {
        $user = new User;
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->remember_token = Str::random(60);
        $user->role = 'siswa';
        $user->save();

        $data = $request->all();
        $data['user_id'] = $user->id;
        Siswa::create($data);

        \Mail::to($user->email)->send(new NotifPendaftaranSiswa);
        return redirect('/')->with('sukses','Pendaftaran Berhasil');
        

    }

    public function singlepost($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('sites.singlepost', compact('post'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Siswa;
use App\User;
use App\Mapel;
use PDF;
use Auth;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('cari'))
        {
            $data_siswa = Siswa::where('nama_depan','LIKE', '%' . $request->cari . '%')->get();
        } else 
        {
            $data_siswa = Siswa::all();
        }
        return view('siswa.index', compact('data_siswa'));
    }

    public function create(Request $request)
    {

        $this->validate($request,[
            'nama_depan' => 'required|min:3',
            'nama_belakang' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'jenis_kelamin' => 'required',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'avatar' => 'mimes:jpeg,png'
        ]);

        $user = new User;
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt('rahasia');
        $user->remember_token = Str::random(60);
        $user->role = 'siswa';
        $user->save();

        $data = $request->all();
        $data['user_id'] = $user->id;
        if($request->avatar){
            $data['avatar'] = $request->file('avatar')->store('assets/siswa','public');
        };
        Siswa::create($data);
        return redirect('/siswa')->with('sukses','Data berhasil di input');
    }

    public function edit($id)
    {
        $siswa = Siswa::find($id);
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        if($request->avatar){
            $data['avatar'] = $request->file('avatar')->store('assets/siswa','public');
        };
        $item = Siswa::find($id);
        $item->update($data);
        return redirect('/siswa')->with('sukses','Data berhasil di update');
    }

    public function delete($id)
    {
        $item = Siswa::find($id);
        $item->delete();
        return redirect('/siswa')->with('sukses','Data berhasil di delete');
    }

    public function profile($id)
    {
        $siswa = Siswa::find($id);
        $mata_pelajaran = Mapel::all();

        $categories = [];
        $data = [];
        foreach($mata_pelajaran as $mp){
            if($siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()){
                $categories[] = $mp->nama;
                $data[] = $siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()->pivot->nilai;
            }
        }
        return view('siswa.profile', compact('siswa','mata_pelajaran','categories','data'));
    }

    public function editnilai(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        if($siswa->mapel()->where('mapel_id', $request->mapel)->exists()){
            return redirect('siswa/' .$siswa->id. '/profile')->with('error','Mata Pelajaran sudah ada');
        }
        $siswa->mapel()->attach($request->mapel,['nilai' => $request->nilai]);
        return redirect('siswa/' .$siswa->id. '/profile')->with('sukses','Mata Pelajaran berhasil di tambah');
    }

    public function deletenilai($siswaId, $mapelId)
    {
        $siswa = Siswa::find($siswaId);
        $siswa->mapel()->detach($mapelId);
        return redirect()->back()->with('sukses','Nilai berhasil di hapus');
    }

    public function exportPdf()
    {
        $siswa = Siswa::all();
        $pdf = PDF::loadView('export.siswaPdf', compact('siswa'));
        return $pdf->download('siswa.pdf');
    }

    public function getdatasiswa()
    {
        $siswa = Siswa::select('siswa.*');
        return \DataTables::eloquent($siswa)
        ->addColumn('namaLengkap', function($s){
            return '<a href="siswa/'.$s->id.'/profile">'.$s->nama_depan.'</a>' .' '. 
            '<a href="siswa/'.$s->id.'/profile">'.$s->nama_belakang.'</a>';
        })
        ->addColumn('rata2Nilai', function($s){
            return $s->rataRataNilai();
        })
        ->addColumn('aksi', function($s){
            return '<a href="siswa/'.$s->id.'/edit" class="btn btn-sm btn-warning">Edit</a>' . ' ' . 
            '<a href="siswa/'.$s->id.'/delete" class="btn btn-sm btn-danger">Delete</a>';
        })
        ->rawColumns(['rata2Nilai','aksi','namaLengkap'])
        ->toJson();
    }

    public function profilesaya()
    {
        $siswa = Auth::user()->siswa;
        return view('siswa.profilesaya', compact('siswa'));
    }
}

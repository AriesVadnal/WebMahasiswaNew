@extends('layouts.master')

@section('content')
<div class="main">
  <div class="main-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
      <div class="row">
        <div class="col-12">
          <h1>Edit Siswa</h1>
        </div>
        <div class="col-12">
            <form action="/siswa/{{$siswa->id}}/update" method="POST" enctype="multipart/form-data">
            @csrf 
            <div class="form-group">
              <label for="nama_depan">Nama Depan</label>
              <input type="text" class="form-control" value="{{$siswa->nama_depan}}" name="nama_depan" id="nama_depan" aria-describedby="emailHelp" placeholder="Nama Depan">
            </div>
            <div class="form-group">
              <label for="nama_belakang">Nama Belakang</label>
              <input type="text" class="form-control" value="{{$siswa->nama_belakang}}" name="nama_belakang" id="nama_belakang" aria-describedby="emailHelp" placeholder="Nama Belakang">
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Jenis Kelamin</label>
              <select class="form-control" name="jenis_kelamin" id="exampleFormControlSelect1">
                <option value="L" @if($siswa->jenis_kelamin == 'L') selected @endif>Laki Laki</option>
                <option value="P" @if($siswa->jenis_kelamin == 'P') selected @endif>Perempuan</option>
              </select>
            </div>
            <div class="form-group">
              <label for="agama">Agama</label>
              <input type="text" class="form-control" value="{{$siswa->agama}}" name="agama" id="agama" aria-describedby="emailHelp" placeholder="Agama">
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <input type="text" class="form-control" value="{{$siswa->alamat}}" name="alamat" id="alamat" aria-describedby="emailHelp" placeholder="Alamat">
            </div>
            <div class="form-group">
              <label for="avatar">Avatar</label>
              <input type="file" class="form-control" name="avatar" id="avatar" aria-describedby="emailHelp">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
          </div>
        </div>
      </div>
      </div>
      </div>
    </div>
  </div>
</div>
@endsection
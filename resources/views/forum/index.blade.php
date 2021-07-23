@extends('layouts.master')

@section('content')
<div class="main">
     <div class="main-content">
        <div class="container_fluid">
           <div class="row">
              <div class="col-md-12">
              <div class="panel">
              <div class="panel panel-scrolling">
                 <button type="button" class="btn btn-primary btn-sm mt-3 float-right" data-toggle="modal" data-target="#exampleModal">
                    Tambah Forum
                  </button>
								<div class="panel-heading">
									<h3 class="panel-title">Forum Diskusi</h3>
								</div>
									<ul class="list-unstyled activity-list">
                  @foreach($forum as $frm)
										<li>
											<img src="{{ $frm->user->siswa->avatar ? Storage::url($frm->user->siswa->avatar) : asset('/images/default.jpg')}}" alt="Avatar" class="img-circle pull-left avatar" style="margin-left: 20px; margin-right: 20px;">
											<p><a href="/forum/{{$frm->id}}/view">{{$frm->user->name}}</a> {{$frm->konten}} <span class="timestamp">{{$frm->created_at->diffForHumans()}}</span></p>
										</li>
                  @endforeach
									</ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/forum/create" method="POST" enctype="multipart/form-data">
        @csrf 
        <div class="form-group{{$errors->has('judul') ? 'has-error' : ''}}">
          <label for="judul">Nama Depan</label>
          <input type="text" class="form-control" name="judul" value="{{ old('judul')}}" id="judul" aria-describedby="emailHelp" placeholder="Judul">
          @if($errors->has('judul'))
              <span class="help-block">{{$errors->first('judul')}}</span>
          @endif
        </div>
        <div class="form-group{{$errors->has('konten') ? 'has-error' : ''}}">
          <label for="konten">Konten</label>
          <textarea name="konten" id="" cols="30" name="konten" class="form-control" rows="10"></textarea>
          @if($errors->has('konten'))
              <span class="help-block">{{$errors->first('konten')}}</span>
          @endif
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

@extends('layouts.master')

@section('content')
<div class="main">
     <div class="main-content">
        <div class="container_fluid">
           <div class="row">
              <div class="col-md-12">
              <div class="panel">
								<div class="panel-heading">
                <h3 class="panel-title">{{$forum->judul}}</h3>
                <p class="panel-subtitle">{{$forum->created_at->diffForHumans()}}</p>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
										<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
									</div>
								</div>
								<div class="panel-body">
                {!!$forum->konten!!}
                <hr>
              <h3>Komentar</h3>
              <div class="btn-group">
                  <button class="btn btn-default"><i class="fa fa-thumbs-up"></i> Suka</button>
                  <button class="btn btn-default" id="btn-komentar-utama"><i class="fa fa-comment"></i> Komentar</button>
              </div>
              <form action="" style="margin-top:10px;display:none" id="komentar-utama" method="POST">
                @csrf 
                <input type="hidden" name="forum_id" value="{{$forum->id}}">
                <input type="hidden" name="parent" value="0">
                <textarea name="konten" class="form-control"></textarea>
                <input type="submit" class="btn btn-primary" value="Kirim">
              </form>
                 <ul class="list-unstyled activity-list">
										@foreach($forum->komentar()->where('parent',0)->orderBy('created_at','desc')->get() as $komentar)
                    <li>
											<img src="
                      {{ $komentar->user->siswa->avatar ? Storage::url($komentar->user->siswa->avatar) : asset('/images/default.jpg')}}
                      " alt="Avatar" class="img-circle pull-left avatar">
											<p><a href="#">{{$komentar->user->name}}</a> {{$komentar->konten}} <span class="timestamp">{{$komentar->created_at->diffForHumans()}}</span></p>
										</li>
                    <form action="" method="POST">
                      @csrf 
                      <input type="hidden" name="forum_id" value="{{$forum->id}}">
                      <input type="hidden" name="parent" value="{{$komentar->id}}">
                      <textarea name="konten" class="form-control" style="height: 30px;" required></textarea>
                      <input type="submit" class="btn btn-primary" value="Kirim">
                    </form>
                    <br>
                    @foreach($komentar->childs as $child)
                    <p><a href="#">{{$child->user->name}}</a> {{$child->konten}} <br> <span class="timestamp">{{$child->created_at->diffForHumans()}}</span></p>
                    @endforeach
                    @endforeach
								</ul>
								</div>
							</div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@push('addon_script')
  <script>
    $(document).ready(function(){
      $('#btn-komentar-utama').click(function(){
        $('#komentar-utama').toggle('slide');
      });
    });
  </script>
@endpush
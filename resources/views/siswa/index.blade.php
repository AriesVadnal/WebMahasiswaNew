@extends('layouts.master')

@section('content')
<div class="main">
  <div class="main-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        <button type="button" class="btn btn-primary btn-sm mt-3 float-right" data-toggle="modal" data-target="#exampleModal">
          Tambah Mahasiswa
        </button>
        <a href="/siswa/exportPdf" class="btn btn-primary btn-sm">ExportPDF</a>
            <div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Table Mahasiswa</h3>
                  @if(session('sukses'))
                  <div class="alert alert-success" role="alert">
                      {{session('sukses')}}
                    </div>
                  @endif
								</div>
								<div class="panel-body">
                <table class="table table-hover" id="myTable">
                  <thead>
                  <tr>
                      <th>Nama Depan</th>
                      <th>Jenis Kelamin</th>
                      <th>Agama</th>
                      <th>Alamat</th>
                      <th>Nilai</th>
                      <th>Aksi</th>
                  </tr>
                  </thead>
                  
                  </table>
								</div>
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
      <form action="/siswa/create" method="POST" enctype="multipart/form-data">
        @csrf 
        <div class="form-group{{$errors->has('nama_depan') ? 'has-error' : ''}}">
          <label for="nama_depan">Nama Depan</label>
          <input type="text" class="form-control" name="nama_depan" value="{{ old('nama_depan')}}" id="nama_depan" aria-describedby="emailHelp" placeholder="Nama Depan">
          @if($errors->has('nama_depan'))
              <span class="help-block">{{$errors->first('nama_depan')}}</span>
          @endif
        </div>
        <div class="form-group{{$errors->has('nama_belakang') ? 'has-error' : ''}}">
          <label for="nama_belakang">Nama Belakang</label>
          <input type="text" class="form-control" name="nama_belakang" value="{{ old('nama_belakang')}}" id="nama_belakang" aria-describedby="emailHelp" placeholder="Nama Belakang">
          @if($errors->has('nama_belakang'))
              <span class="help-block">{{$errors->first('nama_belakang')}}</span>
          @endif
        </div>
        <div class="form-group{{$errors->has('email') ? 'has-error' : ''}}">
          <label for="email">Email</label>
          <input type="email" class="form-control" name="email" value="{{ old('email')}}" id="email" aria-describedby="emailHelp" placeholder="Email">
          @if($errors->has('email'))
              <span class="help-block">{{$errors->first('email')}}</span>
          @endif
        </div>
        <div class="form-group">
          <label for="exampleFormControlSelect1">Jenis Kelamin</label>
          <select class="form-control" name="jenis_kelamin" id="exampleFormControlSelect1">
            <option value="L"{{(old('jenis_kelamin') == 'L') ? 'selected' : ''}}>Laki Laki</option>
            <option value="P"{{(old('jenis_kelamin') == 'P') ? 'selected' : ''}}>Perempuan</option>
          </select>
        </div>
        <div class="form-group{{$errors->has('agama') ? 'has-error' : ''}}">
          <label for="agama">Agama</label>
          <input type="text" class="form-control" name="agama" value="{{ old('agama')}}" id="agama" aria-describedby="emailHelp" placeholder="Agama">
          @if($errors->has('agama'))
              <span class="help-block">{{$errors->first('agama')}}</span>
          @endif
        </div>
        <div class="form-group{{$errors->has('alamat') ? 'has-error' : ''}}">
          <label for="alamat">Alamat</label>
          <input type="text" class="form-control" name="alamat" value="{{ old('alamat')}}" id="alamat" aria-describedby="emailHelp" placeholder="Alamat">
          @if($errors->has('alamat'))
              <span class="help-block">{{$errors->first('alamat')}}</span>
          @endif
        </div>
        <div class="form-group{{$errors->has('avatar') ? 'has-error' : ''}}">
          <label for="avatar">Avatar</label>
          <input type="file" class="form-control" name="avatar" id="avatar" aria-describedby="emailHelp">
          @if($errors->has('avatar'))
              <span class="help-block">{{$errors->first('avatar')}}</span>
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

@push('addon_script')
<script>
$(document).ready(function(){
   $('#myTable').DataTable({
     procession: true,
     serverside: true,
     ajax: "{{ route('ajax.get.data.siswa')}}",
     columns: [
       {data:'namaLengkap',name:'namaLengkap'},
       {data:'jenis_kelamin',name:'jenis_kelamin'},
       {data:'agama',name:'agama'},
       {data:'alamat',name:'alamat'},
       {data:'rata2Nilai',name:'rata2Nilai'},
       {data:'aksi',name:'aksi'},
     ]
   });
});
</script>
@endpush

@extends('layouts.master')

@push('addon_style')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@endpush
@section('content')
<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="panel panel-profile">
						<div class="clearfix">
							<!-- LEFT COLUMN -->
							<div class="profile-left">
								<!-- PROFILE HEADER -->
								<div class="profile-header">
									<div class="overlay"></div>
									<div class="profile-main">
										<img src="{{ $siswa->avatar ? Storage::url($siswa->avatar) : asset('/images/default.jpg')}}" style="width: 100px;" class="img-circle" alt="Avatar">
										<h3 class="name">{{ $siswa->nama_depan }}</h3>
										<span class="online-status status-available">Available</span>
									</div>
									<div class="profile-stat">
										<div class="row">
											<div class="col-md-4 stat-item">
												{{$siswa->mapel->count()}} <span>Mata Pelajaran</span>
											</div>
											<div class="col-md-4 stat-item">
												15 <span>Awards</span>
											</div>
											<div class="col-md-4 stat-item">
												2174 <span>Points</span>
											</div>
										</div>
									</div>
								</div>
								<!-- END PROFILE HEADER -->
								<!-- PROFILE DETAIL -->
								<div class="profile-detail">
									<div class="profile-info">
										<h4 class="heading">Basic Info</h4>
										<ul class="list-unstyled list-justify">
											<li>Nama Depan <span>{{ $siswa->nama_depan}}</span></li>
											<li>Jenis Kelamin <span>{{ $siswa->jenis_kelamin }}</span></li>
											<li>Agama <span>{{ $siswa->agama }}</span></li>
										</ul>
									</div>
									<div class="text-center"><a href="/siswa/{{$siswa->id}}/edit" class="btn btn-warning">Edit Profile</a></div>
								</div>
								<!-- END PROFILE DETAIL -->
							</div>
							<!-- END LEFT COLUMN -->
							<!-- RIGHT COLUMN -->
							<div class="profile-right">
								<!-- END AWARDS -->
								<div class="panel">
                <button type="button" class="btn btn-primary btn-sm mt-3 float-right" data-toggle="modal" data-target="#exampleModal">
                      Tambah Nilai Siswa
                    </button>
								<div class="panel-heading">
									<h3 class="panel-title">Mata Pelajaran</h3>
                  @if(session('sukses'))
                     <div class="alert alert-success mt-2" role="alert">
                      {{session('sukses')}}
                     </div>
                  @endif
                  @if(session('error'))
                     <div class="alert alert-danger mt-2" role="alert">
                      {{session('error')}}
                     </div>
                  @endif
								</div>
								<div class="panel-body">
									<table class="table">
										<thead>
											<tr>
												<th>Kode</th>
												<th>Nama</th>
												<th>Semester</th>
												<th>Nilai</th>
                        <th>Guru</th>
                        <th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											@foreach($siswa->mapel as $mapel)
                      <tr>
												<td>{{$mapel->kode}}</td>
												<td>{{$mapel->nama}}</td>
												<td>{{$mapel->semester}}</td>
												<td><a href="#" class="editnilai" data-type="text" data-pk="{{$mapel->id}}" 
                        data-url="/api/siswa/{{$siswa->id}}/editnilai" data-title="Enter username">{{$mapel->pivot->nilai}}</a></td>
                        <td><a href="/guru/{{$mapel->guru_id}}/profile">{{$mapel->guru->nama}}</a></td>
                        <td>
                          <a href="/siswa/{{$siswa->id}}/{{$mapel->id}}/deletenilai" class="btn btn-sm btn-danger">Delete</a>
                        </td>
											</tr>
                      @endforeach
										</tbody>
									</table>
                  <div class="panel">
                    <div id="hightChart">
                    
                    </div>
                  </div>
								</div>
							</div>
								<!-- END TABBED CONTENT -->
							</div>
							<!-- END RIGHT COLUMN -->
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
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
      <form action="/siswa/{{$siswa->id}}/editnilai" method="POST" enctype="multipart/form-data">
        @csrf 
        <div class="form-group{{$errors->has('mapel') ? 'has-error' : ''}}">
          <label for="mapel">Mapel</label>
          <select name="mapel" id="mapel" class="form-control">
            @foreach($mata_pelajaran as $mp)
              <option value="{{$mp->id}}">{{$mp->nama}}</option>
            @endforeach
          </select>
          @if($errors->has('mapel'))
              <span class="help-block">{{$errors->first('mapel')}}</span>
          @endif
        </div>
        <div class="form-group{{$errors->has('nilai') ? 'has-error' : ''}}">
          <label for="nilai">Nilai</label>
          <input type="text" class="form-control" name="nilai" value="{{ old('nilai')}}" id="nilai" aria-describedby="emailHelp" placeholder="Nilai">
          @if($errors->has('nilai'))
              <span class="help-block">{{$errors->first('nilai')}}</span>
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
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script>
Highcharts.chart('hightChart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Rata Rata Nilai'
    },
    xAxis: {
        categories: {!!json_encode($categories)!!},
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Grafik'
        }
    },
    tooltip: {
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Nilai',
        data: {!!json_encode($data)!!}

    }]
});
$(document).ready(function() {
    $('.editnilai').editable();
});
</script>
@endpush
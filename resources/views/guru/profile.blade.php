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
										<img src="#" style="width: 100px;" class="img-circle" alt="Avatar">
										<h3 class="name">{{ $guru->nama }}</h3>
										<span class="online-status status-available">Available</span>
									</div>
									<div class="profile-stat">
										<div class="row">
											<div class="col-md-4 stat-item">
												{{$guru->mapel->count()}} <span>Jumlah Mata Pelajaran</span>
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
											<li>Nama <span>{{ $guru->nama}}</span></li>
											<li>Telpon <span>{{ $guru->telpon }}</span></li>
											<li>Alamat <span>{{ $guru->alamat }}</span></li>
										</ul>
									</div>
								</div>
								<!-- END PROFILE DETAIL -->
							</div>
							<!-- END LEFT COLUMN -->
							<!-- RIGHT COLUMN -->
							<div class="profile-right">
								<!-- END AWARDS -->
								<div class="panel">
                <h3>Mata Pelajaran Yang Di Ajar Oleh <strong>{{$guru->nama}}</strong></h3>
								<div class="panel-body">
									<table class="table">
										<thead>
											<tr>
												<th>Pelajaran</th>
												<th>Semester</th>
											</tr>
										</thead>
										<tbody>
											@foreach($guru->mapel as $mapel)
                      <tr>
												<td>{{$mapel->nama}}</td>
												<td>{{$mapel->semester}}</td>
											</tr>
                      @endforeach
										</tbody>
									</table>
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
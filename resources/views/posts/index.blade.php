@extends('layouts.master')

@section('content')
<div class="main">
  <div class="main-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        <div class="panel">
						<div class="panel-heading">
									<h3 class="panel-title">Daftar Post</h3>
                  <a href="/post/add" class="btn btn-sm btn-primary">Add New Post</a>
								</div>
								<div class="panel-body">
									<table class="table">
										<thead>
											<tr>
												<th>ID</th>
												<th>TITLE</th>
												<th>USER</th>
												<th>ACTION</th>
											</tr>
										</thead>
										<tbody>
											@foreach($posts as $post)
                      <tr>
												<td>{{ $post->id }}</td>
												<td>{{ $post->title}}</td>
												<td>{{ $post->user->name}}</td>
												<td>
                          <a target="_blank" href="{{ route('singlepost', $post->slug)}}" class="btn btn-info btn-sm">View</a>
                          <a href="/post/{{$post->id}}/edit" class="btn btn-sm btn-warning">Edit</a>
                          <a href="/post/{{$post->id}}/delete" class="btn btn-sm btn-danger">Delete</a>
                        </td>
											</tr>
                      @endforeach
										</tbody>
									</table>
								</div>
							</div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@extends('layouts.master')


@section('content')
  <div class="main">
    <div class="main-content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="panel">
              <div class="panel-heading">
                 <h3 class="panel-title">Add ne Post</h3>
              </div>
              <div class="panel-body">
                 <div class="row">
                   <div class="col-md-8">
                   <form method="POST" action="{{ route('posts.create') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group{{ $errors->has('title') ? ' has-error ' : ''}}">
                      <label for="title">Title</label>
                      <input name="title" type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Title" value="{{ old('title')}}" require>
                      @if ( $errors->has('title'))
                        <span class="help-block">{{ $errors->first('title')}}</span>
                      @endif
                    </div>

                    <div class="form-group">
                      <label for="editor">Content</label>
                      <textarea name="content" class="form-control" id="editor" rows="3" require>{{ old('content')}}</textarea>
                    </div>

                   </div>
                   <div class="col-md-4">
                   <div class="form-group{{ $errors->has('thumbnail') ? ' has-error ' : ''}}">
                        <label for="thumbnail">Thumbnail</label>
                        <input name="thumbnail" type="file" class="form-control">
                        @if ( $errors->has('thumbnail'))
                          <span class="help-block">{{ $errors->first('thumbnail')}}</span>
                        @endif
                      </div>

                      <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                   </div>
                   </form>
                 </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@push('addon_script')
<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
<script>
  ClassicEditor
    .create( document.querySelector( '#editor' ) )
      .then( editor => {
        console.log( editor );
      })
    .catch( error => {
        console.error( error );
    });
</script>
@endpush

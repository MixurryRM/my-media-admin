@extends('admin.layouts.app')

@section('content')

<div class="row my-5">
    <div class="col-8 offset-2">
      <div class="card mt-4">
        <div class="card-header">
            <img class="card-img-top rounded shadow-sm ml-5"
            @if ($post['image'] == null)
            src="{{asset('defaultImage/default.jpg')}}"
            @else
            src="{{asset('postImage/'.$post['image'])}}"
            @endif style="width: 380px;height: 380px">
        </div>
        <div class="card-body">
            <h5 class="card-title mb-2">{{ $post['title']}}</h5>
            <p class="card-text">{{ $post['description']}}</p>
        </div>
        <div class="card-footer">
            <a onclick="history.back()">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
      <!-- /.card -->
    </div>
  </div>

@endsection

@extends('admin.layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header">

          <h3 class="card-title">
            <a href="{{route('admin#postCreatePage')}}"><button class="btn btn-sm btn-outline-dark">Add Post</button></a>
          </h3>

          <div class="card-tools">
            <form action="{{route('admin#postListSearch')}}" method="post">
                @csrf
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="key" class="form-control float-right" value="{{old('key')}}"  placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
            </form>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap text-center">
            <thead>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Category Id</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($post as $item)
              <tr>
                <td>{{$item['post_id']}}</td>
                <td>
                  <img @if ($item['image'] == null)
                      src="{{asset('defaultImage/default.jpg')}}"
                  @else
                      src="{{asset('postImage/'.$item['image'])}}"
                  @endif class="shadow-sm rounded" style="height: 50px" width="50px">
                </td>
                <td>{{ $item['title']}}</td>
                <td>{{ $item['description']}}</td>
                <td>{{ $item['category_id'] }}</td>
                <td>
                  <a href="{{route('admin#editPage',$item['post_id'])}}"> <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                  <a href="{{route('admin#postDelete',$item['post_id'])}}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="pt-3 px-2">{{$post -> links()}}</div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection

@extends('admin.layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-12">
      <div class="card mt-3">
        <div class="card-header">

            @if (session('createSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('createSuccess')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

             @if (session('updateSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('updateSuccess')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif


            @if (session('deleteSuccess'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ session('deleteSuccess')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

          <h3 class="card-title">
            <a href="{{route('admin#categoryCreatePage')}}"><button class="btn btn-sm btn-outline-dark">Add Category</button></a>
          </h3>

        <div class="ml-2 card-title">
            <div class="btn btn-dark shadow-sm text-center">
                 {{ $categoryData->total() }}
            </div>
        </div>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        @if (count($categoryData) != 0)
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap text-center">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Category Name</th>
                  <th>Category Description</th>
                  <th>Created Date</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($categoryData as $c)
                <tr>
                  <td>{{$c['category_id']}}</td>
                  <td>{{$c['name']}}</td>
                  <td>{{$c['description']}}</td>
                  <td>{{$c->created_at->format('j-F-Y')}}</td>
                  <td>
                   <a href="{{route('admin#categoryEditPage',$c['category_id'])}}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                   <a href="{{route('admin#categoryDelete',$c['category_id'])}}"> <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="p-2 mt-0">{{$categoryData -> links()}}</div>
          </div>
        @else
        <h3 class="p-3 text-secondary text-center text-danger">There Is No Category Here!</h3>
        @endif
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
  </div>

</div>
@endsection

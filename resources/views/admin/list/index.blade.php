@extends('admin.layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-12">
      <div class="card">

        <div class="row">
            <div class="col-6 offset-5">
                @if (session('deleteSuccess'))
                 <div class="alert alert-success alert-dismissible fade show"  role="alert">
                    <strong>{{session('deleteSuccess')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>
        </div>

        <div class="card-header">
          <h3 class="card-title">Account List Page</h3>

          <div class="card-tools">
            <form action="{{route('admin#listSearch')}}" method="post">
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
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Gender</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($userData as $u )
              <tr>
                <td>{{ $u['id'] }}</td>
                <td>{{ $u['name'] }}</td>
                <td>{{ $u['email'] }}</td>
                <td>{{ $u['phone'] }}</td>
                <td>{{ $u['address'] }}</td>
                <td>{{ $u['gender'] }}</td>
                <td>
                  <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                  @if (Auth::user()->id != $u['id'])
                  <a href="{{route('admin#delete',$u['id'])}}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                  @else
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <div class=" mt-2">{{ $userData -> links() }}</div>
      <!-- /.card -->
    </div>
  </div>
@endsection

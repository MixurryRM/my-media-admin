@extends('admin.layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-8 offset-3 mt-5">
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <legend class="text-center">User Profile</legend>
          </div>
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="activity">

                {{--update alert start --}}
                @if (session('updateSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('updateSuccess')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                {{-- update alert end --}}

                <form action="{{route('admin#update')}}" class="form-horizontal" method="POST">
                  @csrf
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" value="{{ old('adminName',$user->name) }}" class="form-control @error('adminName')
                          is-invalid
                      @enderror" name="adminName" placeholder="Name">
                      @error('adminName')
                          <div class="invalid-feedback">{{$message}}</div>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" value="{{old('adminEmail',$user->email)}}" class="form-control @error('adminEmail')
                          is-invalid
                      @enderror" name="adminEmail" placeholder="Email">
                      @error('adminEmail')
                          <div class="invalid-feedback">{{$message}}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputphone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                      <input type="number" value="{{$user->phone}}" class="form-control" name="adminPhone"  placeholder="Phone">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputaddress" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                       <textarea name="adminAddress" class="form-control" id="address" cols="30" rows="10">{{$user->address}}</textarea>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                    @if ($user->gender == 'male')
                       <select name="adminGender" class=" form-control">
                        <option value="">Choose Your Option</option>
                        <option value="male" selected>male</option>
                        <option value="female">female</option>
                       </select>
                    @elseif ($user->id == 'female')
                       <select name="adminGender" class=" form-control">
                        <option value="">Choose Your Option</option>
                        <option value="male">male</option>
                        <option value="female" selected>female</option>
                       </select>
                    @else
                       <select name="adminGender" class=" form-control">
                        <option value="" selected>Choose Your Option</option>
                        <option value="male">male</option>
                        <option value="female">female</option>
                    </select>
                       @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <a href="{{route('admin#changePasswordPage')}}">Change Password</a>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn bg-dark text-white">Submit</button>
                    </div>
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
@endsection

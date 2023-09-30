@extends('admin.layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-8 offset-3 mt-5">
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <legend class="text-center">Change Password</legend>
          </div>
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="activity">

                {{--update alert start --}}
                @if (session('fail'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{session('fail')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                {{-- update alert end --}}

                <form action="{{route('admin#changePassword')}}" class="form-horizontal" method="POST">
                  @csrf
                  <div class="form-group row">
                    <label for="oldPassword" class="col-sm-5 col-form-label">Old password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control @error('oldPassword')
                          is-invalid
                      @enderror" name="oldPassword" placeholder="Enter Old Password ...">
                      @error('oldPassword')
                          <div class="invalid-feedback">{{$message}}</div>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="newPassword" class="col-sm-5 col-form-label">New Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control @error('newPassword')
                          is-invalid
                      @enderror" name="newPassword" placeholder="Enter New Password ...">
                      @error('newPassword')
                          <div class="invalid-feedback">{{$message}}</div>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="confirmPassword" class="col-sm-5 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control @error('confirmPassword')
                          is-invalid
                      @enderror" name="confirmPassword"  placeholder="Enter Confirm Password ...">
                      @error('confirmPassword')
                      <div class="invalid-feedback">{{$message}}</div>
                  @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="offset-sm-1 col-sm-10 pt-2">
                      <button type="submit" class="w-75 btn bg-dark text-white">Submit</button>
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

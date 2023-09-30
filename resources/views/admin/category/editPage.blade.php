@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card">
                <div class="card-header">
                    Edit Category
                </div>
                <div class="card-body">
                    <form action="{{route('admin#categoryUpdate',$categoryData['category_id'])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="categoryName">Category Name</label>
                            <input type="text" class="form-control @error('categoryName')
                                is-invalid
                            @enderror" value="{{old('categoryName',$categoryData['name'])}}" name="categoryName" placeholder="Enter category name">
                            @error('categoryName')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="categoryDescription">Category Description</label>
                            <textarea class="form-control @error('categoryDescription')
                                is-invalid
                            @enderror" name="categoryDescription" rows="3" placeholder="Enter category description">{{old('categoryDescription',$categoryData['description'])}}</textarea>
                            @error('categoryDescription')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

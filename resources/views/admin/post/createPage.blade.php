@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card">
                <div class="card-header">
                    Create Post
                </div>
                <div class="card-body">
                    <form action="{{route('admin#postCreate')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="postTitle">Title</label>
                            <input type="text" class="form-control @error('postTitle')
                                is-invalid
                            @enderror" name="postTitle" placeholder="Enter Post Title ...">
                            @error('postTitle')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="postImage">Image</label>
                            <input type="file" name="postImage" class="form-control @error('postImage')
                                is-invalid
                            @enderror">
                            @error('postImage')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                        </div>

                        <div class="form-group">
                            <label for="postDescription">Description</label>
                            <textarea class="form-control @error('postDescription')
                                is-invalid
                            @enderror" name="postDescription" rows="3" placeholder="Enter Post Description ..."></textarea>
                            @error('postDescription')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Category Name</label>
                            <select name="postCategory" class="form-control @error('postCategory')
                                is-invalid
                            @enderror">
                                <option value="">Choose Category ...</option>
                                @foreach ($categoryData as $item)
                                   <option value="{{$item['category_id']}}">{{$item['name']}}</option>
                                @endforeach
                            </select>
                            @error('postCategory')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

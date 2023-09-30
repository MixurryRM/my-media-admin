@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card">
                <div class="card-header">
                    Edit Post
                </div>
                <div class="card-body">
                    <form action="{{ route('admin#postUpdate',$postData['post_id'])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="postTitle">Title</label>
                            <input type="text" class="form-control @error('postTitle')
                                is-invalid
                            @enderror" name="postTitle" value="{{old('postTitle',$postData['title'])}}" placeholder="Enter Post Title ...">
                        </div>

                        <div class="form-group">
                            <label for="postDescription">Description</label>
                            <textarea class="form-control @error('postDescription')
                                is-invalid
                            @enderror" name="postDescription" rows="3" placeholder="Enter Post Description ...">{{old('postDescription',$postData['description'])}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="postImage">Image</label>
                             <img @if ($postData['image'] == null)
                                 src="{{ asset('defaultImage/default.jpg') }}"
                             @else
                             src="{{ asset('postImage/' . $postData['image']) }}"
                             @endif class="w-25 shadow-sm rounded d-block" alt="">
                        </div>
                        <input type="file" name="postImage" class="form-control @error('postImage')
                        is-invalid
                    @enderror">

                        <div class="form-group mt-3">
                            <label>Category Name</label>
                            <select name="postCategory" class="form-control @error('postCategory')
                                is-invalid
                            @enderror">
                                @foreach ($categoryData as $item)
                                   <option value="{{$item['category_id']}}" @if ($item['category_id'] == $postData['category_id'])
                                       selected
                                   @endif>{{$item['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

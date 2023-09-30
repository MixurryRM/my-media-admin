<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class postController extends Controller
{
    public function getAllPost(){
        $post = Post::get();

        return response()->json([
            'status' => 'success',
            'post' => $post
        ], 200);
    }
    //post search
    public function postSearch(Request $request){

        $post = Post::where('title','LIKE','%'.$request->key.'%')->get();
         return response()->json([
            'searchData' => $post
         ]);
    }
    //post details
    public function postDetails(Request $request){
        $id = $request->postId;
        $post = Post::where('post_id',$id)->first();

        return response()->json([
            'post' => $post
        ]);
    }
}

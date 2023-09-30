<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Actionlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;

class TrendPostController extends Controller
{
    public function index(){
        $post = Actionlog::select('actionlogs.*','posts.*',DB::raw('COUNT(actionlogs.post_id) as post_count'))
              ->leftJoin('posts','posts.post_id','actionlogs.post_id')
              ->groupBy('actionlogs.post_id')
              ->get();
            //   dd($post->toArray());
        return view('admin.trend_post.index',compact('post'));
    }

    public function details($id){
        $post = Post::where('post_id',$id)->first();
        return view('admin.trend_post.detail',compact('post'));
    }
}

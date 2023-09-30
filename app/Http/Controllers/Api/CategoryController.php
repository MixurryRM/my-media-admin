<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Console\View\Components\Alert;

class CategoryController extends Controller
{
    //get all category
    public function getAllCategory(){
        $category = Category::select('category_id','name','description')->get();

        return response()->json([
            'category' => $category,
        ]);
    }

    //category search
    public function categorySearch(Request $request){

        $category = Category::select('posts.*')
                  -> join('posts','categories.category_id','posts.category_id')
                  -> where('categories.name','LIKE','%'.$request->key.'%')->get();
         return response()->json([
            'searchData' => $category
         ]);
    }
}

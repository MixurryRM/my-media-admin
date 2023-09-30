<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Actionlog;
use Illuminate\Http\Request;

class ActionLogController extends Controller
{
    //set actionlog
    public function setActionLog(Request $request){

        $data = [
        'user_id' => $request->user_id ,
        'post_id' => $request->post_id
        ];

        Actionlog::create($data);//insert

         $data = Actionlog::where('post_id',$request->post_id)->get();

        return response()->json(
            ['post' =>$data ]
        );

    }
}

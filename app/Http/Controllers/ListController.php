<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    //direct admin list page
    public function index(){
        $userData = User::paginate(3);
        return view("admin.list.index",compact('userData'));
     }

     //admin account delete
     public function adminDelete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'User Account Deleted!']);
     }

     //admin list key
     public function  adminListSearch(Request $request){
        $userData = User:: orWhere('name','like','%'.$request->key.'%')
        -> orWhere('email','like','%'. $request->key .'%')
        -> orWhere('phone','like','%'. $request->key .'%')
        -> orWhere('address','like','%'. $request->key .'%')
        -> orWhere('gender','like','%'. $request->key .'%')
        ->paginate(3);
    return view('admin.list.index',compact('userData'));

    }
}

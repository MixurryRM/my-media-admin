<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function getUser(){
        $user = User::get();

        return response()->json([
            'user' => $user
        ]);
    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrendPostController;
use App\Models\Category;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    //admin profile
    Route::get('dashboard',[ProfileController::class,'index'])->name('dashboard');
    Route::post('admin/update',[ProfileController::class,'adminUpdate'])->name('admin#update');
    Route::get('admin/change/password/page',[ProfileController::class,'changePasswordPage'])->name('admin#changePasswordPage');
    Route::post('admin/change/password',[ProfileController::class,'changePassword'])->name('admin#changePassword');

    //admin list
    Route::get('admin/list',[ListController::class,'index'])->name('admin#list');
    Route::get('admin/delete/{id}',[ListController::class,'adminDelete'])->name('admin#delete');
    Route::post('admin/list',[ListController::class,'adminListSearch'])->name('admin#listSearch');

    //category
    Route::get('category',[CategoryController::class,'index'])->name('category');
    Route::get('category/create',[CategoryController::class,'categoryCreatePage'])->name('admin#categoryCreatePage');
    Route::post('category/create',[CategoryController::class,'categoryCreate'])->name('admin#categoryCreate');
    Route::get('category/delete/{id}',[CategoryController::class,'categoryDelete'])->name('admin#categoryDelete');
    Route::get('category/editPage/{id}',[CategoryController::class,'categoryEditPage'])->name('admin#categoryEditPage');
    Route::post('category/update/{id}',[CategoryController::class,'categoryUpdate'])->name('admin#categoryUpdate');

    //post
    Route::get('post',[PostController::class,'index'])->name('post');
    Route::get('post/create',[PostController::class,'postCreatePage'])->name('admin#postCreatePage');
    Route::post('post/create',[PostController::class,'postCreate'])->name('admin#postCreate');
    Route::get('post/delete/{id}',[PostController::class,'postDelete'])->name('admin#postDelete');
    Route::get('post/edit/{id}',[PostController::class,'postEditPage'])->name('admin#editPage');
    Route::post('post/update/{id}',[PostController::class,'postUpdate'])->name('admin#postUpdate');
    Route::post('post/list',[PostController::class,'postListSearch'])->name('admin#postListSearch');

    //trend_post
    Route::get('trend/post',[TrendPostController::class,'index'])->name('trend#post');
    Route::get('trend/detail/{id}',[TrendPostController::class,'details'])->name('trend#detail');
});

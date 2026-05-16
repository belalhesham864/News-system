<?php

use App\Http\Controllers\Api\General\CategoryController;
use App\Http\Controllers\Api\General\GeneralController;
use App\Http\Controllers\Api\General\PostController;
use App\Http\Controllers\Api\General\SearchController;
use App\Http\Controllers\Api\General\SettingController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('posts',[GeneralController::class,'getPosts']);
Route::get('post/show/{slug}',[PostController::class,'showPost']);
Route::get('post/comment/{slug}',[PostController::class,'getpostcomment']);

Route::get('setting',[SettingController::class,'getsetting']);

Route::get('category',[CategoryController::class,'getCategories']);
Route::get('category/{slug}/posts',[CategoryController::class,'getCategoryposts']);
Route::post('search',SearchController::class);
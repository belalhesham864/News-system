<?php

use App\Http\Controllers\Api\General\GeneralController;
use App\Http\Controllers\Api\General\PostController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('posts',[GeneralController::class,'getPosts'])->name('General');
Route::get('post/show/{slug}',[PostController::class,'showPost'])->name('showPost');
<?php

use App\Http\Controllers\Forntend\CategoryController;
use App\Http\Controllers\Forntend\ContactUsController;
use App\Http\Controllers\Forntend\HomeController;
use App\Http\Controllers\Forntend\NewsSubscrriberController;
use App\Http\Controllers\Forntend\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('forntend.index');
// });
// Route::get('/contact', function () {
//     return view('forntend.contact-us');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['as'=>'forntend.',],function(){
Route::get('/',[HomeController::class,'index'])->name('index');
Route::post('/news-sub',[NewsSubscrriberController::class,'store'])->name('subscribe');
Route::get('category/{slug}',CategoryController::class)->name('category.posts');
Route::get('post/{slug}',[PostController::class,'show'])->name('post.show');
Route::get('post/comment/{slug}',[PostController::class,'getallcomment'])->name('post.getallcomment');
Route::post('post/comment/store',[PostController::class,'savecomment'])->name('post.comment.store');

///////// contact us /////////// 
Route::get('/contact-us',[ContactUsController::class,'index'])->name('contact');
Route::post('/contact-us',[ContactUsController::class,'store'])->name('contact.store');

});

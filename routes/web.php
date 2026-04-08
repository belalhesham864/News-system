<?php

use App\Http\Controllers\Forntend\CategoryController;
use App\Http\Controllers\Forntend\ContactUsController;
use App\Http\Controllers\Forntend\HomeController;
use App\Http\Controllers\Forntend\NewsSubscrriberController;
use App\Http\Controllers\Forntend\PostController;
use App\Http\Controllers\Forntend\SearchController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use function Laravel\Prompts\search;

// Route::get('/', function () {
//     return view('forntend.index');
// });
// Route::get('/contact', function () {
//     return view('forntend.contact-us');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['as'=>'forntend.',],function(){
    //////////////// home page /////////////////////////
Route::get('/',[HomeController::class,'index'])->name('index');
/////////////// NewsSubscrribe /////////////////////////////////////
Route::post('/news-sub',[NewsSubscrriberController::class,'store'])->name('subscribe');
//////////////// category Post //////////////////////////////////
Route::get('category/{slug}',CategoryController::class)->name('category.posts');
///////// show post ////////////////////////////////
Route::controller(PostController::class)->name('post.')->prefix('post')->group(function(){
Route::get('/{slug}','show')->name('show');
Route::get('/comment/{slug}','getallcomment')->name('getallcomment');
Route::post('/comment/store','savecomment')->name('comment.store');
});
///////// contact us /////////// 
Route::controller(ContactUsController::class)->prefix('contact-us')->group(function(){
    Route::get('/','index')->name('contact');
    Route::post('/','store')->name('contact.store');
    });
      
    ///////////// Search Post //////////////////
    Route::match(['get','post'],'Search/',SearchController::class)->name('search');

});



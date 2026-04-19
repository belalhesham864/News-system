<?php

use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Forntend\CategoryController;
use App\Http\Controllers\Forntend\ContactUsController;
use App\Http\Controllers\Forntend\HomeController;
use App\Http\Controllers\Forntend\NewsSubscrriberController;
use App\Http\Controllers\Forntend\dashboard\NotifactionController;
use App\Http\Controllers\Forntend\dashboard\porfilecontroller;
use App\Http\Controllers\Forntend\PostController;
use App\Http\Controllers\Forntend\SearchController;
use App\Http\Controllers\Forntend\dashboard\SettingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use function Laravel\Prompts\search;

// Route::get('/', function () {
//     return view('forntend.index');
// });
// Route::get('/contact', function () {
//     return view('forntend.contact-us');
// });

/////////////AUTH//////////////////////////////
Route::controller(VerificationController::class)->prefix('email')->name('verification.')->group(function(){

    Route::get('/verify', 'show')->name('notice');
    Route::get('/verify/{id}/{hash}', 'verify')->name('verify');
    Route::post('/resend','resend')->name('resend');
    });

Auth::routes();

Route::get('test',function(){
return view('forntend.dashboard.notifaction');
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::redirect('/','/home');


Route::group(['as'=>'forntend.',],function(){
    //////////////// home page /////////////////////////
Route::get('/home',[HomeController::class,'index'])->name('index');
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
    
/////////////// dashboard user /////////////////
Route::prefix('account/')->name('dashboard.')->middleware(['auth:web','verified'])->group(function(){
    // manage porfile
  Route::controller(porfilecontroller::class)->group(function(){
  Route::get('porfile','index')->name('porfile');
  Route::post('post/store','store')->name('post.store');
  Route::get('post/edit/{slug}','edit')->name('post.edit');
  Route::put('post/update','update')->name('post.update');
  Route::post('post/image/delete/{image_id}','deletePostimage')->name('post.imagge.delete');
  Route::delete('post/delete/{id}','delete')->name('post.delete');
  Route::get('post/comment/{id}','getallcomment')->name('post.getallcomment');


  });
       ////// setting Porfile //////////////////////////
  Route::controller(SettingController::class)->prefix('setting')->group(function(){
  Route::get('/','getsetting')->name('setting');
  Route::post('/update','update')->name('update');
  Route::match(['get','post'],'/changepassword','changepassword')->name('changepassword');
  });

  //////// Notifaction ///////////
  Route::controller(NotifactionController::class)->prefix('Notifaction/')->name('notifaction.')->group(function(){
    Route::get('','index')->name('show');
    Route::match(['get','post'],'readall','readall')->name('readall');
    Route::match(['get','post'],'Deleteall','Deleteall')->name('Deleteall');
    Route::delete('deleteone/{id}','deleteone')->name('deleteone');
  });
    
        });

});



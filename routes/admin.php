<?php

use App\Http\Controllers\Admin\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\Password\ForgetPassworController;
use App\Http\Controllers\Admin\Auth\Password\ResetPassworController;
use App\Http\Controllers\Admin\Authorization\AuthorizationController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Contact\ContactController;
use App\Http\Controllers\Admin\Home\HomeController;
use App\Http\Controllers\Admin\Notifications\NotificationController;
use App\Http\Controllers\Admin\Porfile\PorfileController;
use App\Http\Controllers\Admin\Posts\PostsController;
use App\Http\Controllers\Admin\Search\SearchController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\User\userController;
use App\Http\Controllers\Forntend\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    
    Route::middleware('auth:admin')->group(function () {
        Route::get('home',[HomeController::class,'index'])->name('home');
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    });

   
    Route::controller(LoginController::class)->middleware('admin.guest')->group(function () {
        Route::get('login', 'showloginform')->name('login.show');
        Route::post('login', 'checkauth')->name('login.checkauth');
    });



    ///////////// forget And reset password //////////////////// 
    Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
        Route::controller(ForgetPassworController::class)->group(function () {

            Route::get('email', 'showEmailForm')->name('email');
            Route::post('email', 'sendotp')->name('sendotp');
            Route::get('verifay/{email}', 'showOtpForm')->name('showOtpForm');
            Route::post('verifay', 'verifayOtp')->name('VerifayOtp');
        });
        Route::controller(ResetPassworController::class)->group(function () {
            Route::get('reset/{email}', 'showform')->name('showformReset');
            Route::post('reset', 'resetPassword')->name('reset');
        });
    });

    Route::middleware('auth:admin')->group(function () {

    ///////////////////Authorization //////////////////////
    Route::resource('authorization',AuthorizationController::class)->middleware('can:authorization');

        ///////////// User Table //////////////////////////
        Route::resource('users', userController::class);
        Route::post('user/block/{id}', [userController::class, 'userBlock'])->name('user.block');

        ////////////// Category Table ///////////////////////////////////
        Route::resource('categories', CategoryController::class);
        Route::post('category/changestatus/{id}', [CategoryController::class, 'changestatus'])->name('category.changestatus');

        ////////////// Post Table /////////////////////////////////////////
        Route::resource('posts', PostsController::class)->middleware('can:posts');
        Route::post('posts/changestatus/{id}', [PostsController::class, 'changestatus'])->name('posts.changestatus');
        Route::post('posts/deleteimage/{id}', [PostsController::class, 'deleteimage'])->name('posts.deleteimage');
        Route::delete('posts/deletecomment/{id}', [PostsController::class, 'deletecomment'])->name('posts.deletecomment');

 /////////////// Setting ///////////////
 Route::resource('setting',SettingController::class)->only(['index','edit','update']);

 //////////////// Admin ///////////////
 Route::resource('admins',AdminController::class)->middleware('can:admins');
         Route::post('admins/changestatus/{id}', [AdminController::class, 'changestatus'])->name('admins.changestatus');
         Route::get('admins/changepassword/{id}', [AdminController::class, 'changePassword'])->name('admins.changePassword');
         Route::post('admins/UpdatePassword', [AdminController::class, 'UpdatePassword'])->name('admins.UpdatePassword');

////////////////// Countact-us //////////////////////////////
         Route::controller(ContactController::class)->prefix('Contact')->as('Contact.')->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/show/{id}','show')->name('show');
        Route::delete('/destory/{id}','destory')->name('destory');
         });

         ///////////////////Porfile //////////////////
         Route::controller(PorfileController::class)->prefix('porfile')->as('porfile.')->group(function(){
            Route::get('/','index')->name('index');
            Route::post('/otp/{id}','SendOtp')->name('otp');
            Route::match(['get','post'],'/verifayotp','verifayotp')->name('verifayotp');
            Route::get('/ChangePassword','ChangePassword')->name('ChangePassword');
            Route::post('/UpdatePassword/{id}','UpdatePassword')->name('UpdatePassword');
         });

         /////////////////Notifaction ////////////////////////////
         Route::get('notification',[NotificationController::class,'index'])->name('notifaction');
         Route::post('notification/{id}',[NotificationController::class,'delete'])->name('notifaction.delete');
         Route::post('DeleteAll',[NotificationController::class,'deleteAll'])->name('notifaction.deleteAll');

         //////////////Search //////////////////////
         Route::get('search',[SearchController::class,'index'])->name('Search');
    });
});

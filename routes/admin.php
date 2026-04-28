<?php

use App\Http\Controllers\Admin\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\Password\ForgetPassworController;
use App\Http\Controllers\Admin\Auth\Password\ResetPassworController;
use App\Http\Controllers\Admin\Authorization\AuthorizationController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Posts\PostsController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\User\userController;
use App\Http\Controllers\Forntend\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

   
    Route::controller(LoginController::class)->middleware('admin.guest')->group(function () {
        Route::get('login', 'showloginform')->name('login.show');
        Route::post('login', 'checkauth')->name('login.checkauth');
    });
    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('home', function () {
            return view('admin.index');
        })->name('home');
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
    Route::resource('authorization',AuthorizationController::class);
        ///////////// User Table //////////////////////////
        Route::resource('users', userController::class);
        Route::post('user/block/{id}', [userController::class, 'userBlock'])->name('user.block');
        ////////////// Category Table ///////////////////////////////////
        Route::resource('categories', CategoryController::class);
        Route::post('category/changestatus/{id}', [CategoryController::class, 'changestatus'])->name('category.changestatus');
        ////////////// Post Table /////////////////////////////////////////
        Route::resource('posts', PostsController::class);
        Route::post('posts/changestatus/{id}', [PostsController::class, 'changestatus'])->name('posts.changestatus');
        Route::post('posts/deleteimage/{id}', [PostsController::class, 'deleteimage'])->name('posts.deleteimage');
 /////////////// Setting ///////////////
 Route::resource('setting',SettingController::class)->only(['index','edit','update']);
 //////////////// Admin ///////////////
 Route::resource('admins',AdminController::class);
         Route::post('admins/changestatus/{id}', [AdminController::class, 'changestatus'])->name('admins.changestatus');

    });
});

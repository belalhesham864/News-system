<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\Password\ForgetPassworController;
use App\Http\Controllers\Admin\Auth\Password\ResetPassworController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\User\userController;
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
    Route::group(['prefix'=>'password', 'as'=>'password.'],function(){
      Route::controller(ForgetPassworController::class)->group(function(){

        Route::get('email','showEmailForm')->name('email');
        Route::post('email','sendotp')->name('sendotp');
        Route::get('verifay/{email}','showOtpForm')->name('showOtpForm');
        Route::post('verifay','verifayOtp')->name('VerifayOtp');
        });
Route::controller(ResetPassworController::class)->group(function(){
      Route::get('reset/{email}','showform')->name('showformReset');
      Route::post('reset','resetPassword')->name('reset');
          });
    });

 Route::middleware('auth:admin')->group(function(){

     Route::resource('users',userController::class);
     Route::post('user/block/{id}',[userController::class,'userBlock'])->name('user.block');
     Route::resource('categories',CategoryController::class);
     Route::post('category/changestatus/{id}',[CategoryController::class,'changestatus'])->name('category.changestatus');
     });

});

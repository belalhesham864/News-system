<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    return view('admin.index');
});

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

});

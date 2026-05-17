<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\Password\ForgetPasswordController;
use App\Http\Controllers\Api\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\VerifayEmailController;
use App\Http\Controllers\Api\General\CategoryController;
use App\Http\Controllers\Api\General\ContactsController;
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


Route::get('posts', [GeneralController::class, 'getPosts']);

//////////////// posts Route ///////////
Route::controller(PostController::class)->prefix('post/')->group(function () {
    Route::get('show/{slug}', 'showPost');
    Route::get('comment/{slug}', 'getpostcomment');
});

Route::get('setting', [SettingController::class, 'getsetting']);
//////////////// category Route ///////////
Route::controller(CategoryController::class)->prefix('category/')->group(function () {
    Route::get('', 'getCategories');
    Route::get('{slug}/posts', 'getCategoryposts');
});
//////////////// Search Route ///////////
Route::post('search', SearchController::class);
//////////////// Contacts Route ///////////
Route::post('contacts', ContactsController::class);



////////////////// auth//////////////
Route::prefix('auth/')->group(function () {

    Route::post('register', [RegisterController::class, 'register']);

    Route::controller(VerifayEmailController::class)->middleware('auth:sanctum')->group(function () {
        Route::post('email/verifay', 'verifay');
        Route::get('email/verifay', 'sendOtpAgain');
    });
    Route::controller(LoginController::class)->group(function () {
        Route::post('login', 'login');
        Route::delete('logout', 'logout')->middleware('auth:sanctum');
        });
        Route::controller(ForgetPasswordController::class)->prefix('password/email')->group(function () {
            Route::post('', 'sendotp');
            Route::post('/checkotp', 'checkOtp');
        });

    Route::post('password/reset',[ResetPasswordController::class,'resetPassword']);
});

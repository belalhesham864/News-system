<?php

use App\Http\Controllers\Api\Account\NotificationController;
use App\Http\Controllers\Api\Account\SettingController as AccountSettingController;
use App\Http\Controllers\Api\Account\PostController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\Password\ForgetPasswordController;
use App\Http\Controllers\Api\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\VerifayEmailController;
use App\Http\Controllers\Api\General\CategoryController;
use App\Http\Controllers\Api\General\ContactsController;
use App\Http\Controllers\Api\General\GeneralController;
use App\Http\Controllers\Api\General\RelatedNewsController;
use App\Http\Controllers\Api\General\SearchController;
use App\Http\Controllers\Api\General\SettingController;
use App\Http\Resources\UserResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->prefix('account/')->group(function () {

    Route::get('user', function (Illuminate\Http\Request $request) {
        return $request->user();
    });
    
    Route::controller(AccountSettingController::class)->prefix('setting/')->group(function () {

        Route::put('', 'updateSetting');
        Route::post('change-password', 'changePassword');
    });
    Route::controller(PostController::class)->prefix('posts/')->group(function () {

        Route::get('', 'getPosts');
        Route::get('get-commentPost/{post_id}', 'getCommentPost');
        Route::post('create', 'createPost');
        Route::post('add-comment/{post_id}', 'AddComment')->middleware('throttle:comment');
        Route::put('Update-Post/{post_id}', 'UpdatedPost');

        Route::delete('destroy/{post_id}', 'destroy');
    });

    Route::get('notifaction', [NotificationController::class, 'getcomment']);
    Route::get('notifaction/read/{id}', [NotificationController::class, 'readnotifaction']);
});

Route::get('unauthorizad', function () {
    return response()->json(['message' => 'unauthorizad'], 401);
})->name('unauthorizad');

Route::get('posts', [GeneralController::class, 'getPosts']);

//////////////// posts Route ///////////
Route::controller(PostController::class)->prefix('post/')->group(function () {
    Route::get('show/{slug}', 'showPost')->name('api.posts.show');
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
Route::post('contacts', ContactsController::class)->middleware('throttle:contact');

////////////// Realted News /////////
Route::get('realted-News', RelatedNewsController::class);

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

    Route::post('password/reset', [ResetPasswordController::class, 'resetPassword']);
});

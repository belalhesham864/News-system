<?php

use App\Http\Controllers\Forntend\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('forntend.index');
// });
Route::get('/contact', function () {
    return view('forntend.contact-us');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/',[HomeController::class,'index'])->name('forntend.index');
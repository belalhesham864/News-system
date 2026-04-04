<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('forntend.index');
});
Route::get('/contact', function () {
    return view('forntend.contact-us');
});

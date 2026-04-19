<?php

use Illuminate\Support\Facades\Route;

Route::get('test', function(){
    return view('dashboard.index');
});

Route::group(['perfix'=>'admin' , 'as'=>'admin', 'middleware'=>'auth:admin'],function(){
    Route::post('')
});
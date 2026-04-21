<?php

use App\Http\Middleware\AdminAuthenticate;
use App\Http\Middleware\CheckAuth;
use App\Http\Middleware\CheckNotifaction;
use App\Http\Middleware\CheckUserStatus;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
        then:function(){

            Route::middleware('web')->group(base_path('routes/admin.php'));
        } 
    )
    ->withMiddleware(function (Middleware $middleware): void {
       $middleware->web(append:[
        CheckNotifaction::class
       ]);
       $middleware->alias([
           'admin.auth'=>CheckAuth::class,
        'admin.guest'=>AdminAuthenticate::class,
       ]);
       $middleware->web(append:[
      CheckUserStatus::class
       ]);
    })
->withExceptions(function (Exceptions $exceptions): void {
    $exceptions->renderable(function (AuthenticationException $exception, $request) {

        if ($request->is('admin/*') || $request->routeIs('admin.*')) {
            return redirect()->route('admin.login.show');
        }

        return redirect()->route('login');
    });
})->create();
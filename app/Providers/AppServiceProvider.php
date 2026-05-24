<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
  foreach(config('authorization.permessions') as $config_permesion=>$value){
 Gate::define($config_permesion,function($auth) use ($config_permesion){
 return $auth->hasAcess($config_permesion);
 });
  }
$this->rateLimiter();
        }
        protected function rateLimiter(){
              RateLimiter::for('contact',function(Request $request){
    return Limit::perDay(5)->by($request->user()?->id ?:$request->ip())->response(function(){
        return apiResponse(429,'Try again After  24 Hours');
    });

  });
  RateLimiter::for('login',function(Request $request){
    return Limit::perHour(5)->by($request->user()?->id ?:$request->ip())->response(function(){
        return apiResponse(429,'Try again After 60 munites');
    });


  });
  RateLimiter::for('comment',function(Request $request){
    return Limit::perMinute(1)->by($request->user()?->id ?:$request->ip())->response(function(){
        return apiResponse(429,'Try again After 60 secound');
    });


  });
        }
}

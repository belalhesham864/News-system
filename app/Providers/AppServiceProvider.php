<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        }
}

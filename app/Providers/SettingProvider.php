<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class SettingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Setting::firstOr(function(){
            return Setting::create([
     'site_name'=>'news',
     'logo'=>'default',
     'favicon'=>'default',
     'email'=>'news@gmail.com',
     'facebook'=>'default',
     'tiwter'=>'default',
     'instgram'=>'default',
     'youtube'=>'default',
     'phone'=>'default',
     'country'=>'default country',
     'city'=>'default city',
     'street'=>'default street',
   
    
            ]);
        });
    }
}

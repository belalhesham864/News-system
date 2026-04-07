<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\RelatedNewsSite;
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
       $setting=Setting::firstOr(function(){
            return Setting::create([
     'site_name'=>'news',
     'logo'=>'/img/logo.png',
     'favicon'=>'default',
     'email'=>'news@gmail.com',
     'facebook'=>'https://www.facebook.com/',
     'tiwter'=>'https://x.com/',
     'instgram'=>'https://www.instagram.com/',
     'youtube'=>'https://www.youtube.com/',
     'phone'=>'01028673838',
     'country'=>'Egypt',
     'city'=>'Mansoura',
     'street'=>'Belqas',
   
    
            ]);
        });

        view()->share([
            'setting'=>$setting,
       
        ]);
    }
}

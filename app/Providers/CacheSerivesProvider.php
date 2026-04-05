<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CacheSerivesProvider extends ServiceProvider
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
        if(!Cache::has('read_post_more')){
            $read_post_more=Post::select('id','title')->latest()->limit(10)->get();
            Cache::remember('read_post_more',3600,function() use($read_post_more){
          return $read_post_more;
            });
        }
        $read_post_more=Cache::get('read_post_more');
        view()->share([
          'read_post_more'=>$read_post_more,
        ]);
    }
}

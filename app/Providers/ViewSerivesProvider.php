<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\RelatedNewsSite;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewSerivesProvider extends ServiceProvider
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
        $relatedsite = RelatedNewsSite::select(['name', 'url'])->get();
        $categories = Category::select('id', 'name', 'slag')->get();


        if (!Cache::has('greats_post_comment')) {
            $greats_post_comment = Post::withCount('comment')->orderBy('comment_count', 'desc')->take(5)->get();
            Cache::remember('greats_post_comment', 3600, function () use ($greats_post_comment) {
                return $greats_post_comment;
            });
        }
        if (!Cache::has('posts')) {
            $posts = Post::with('images')->latest()->paginate(9);
            Cache::remember('posts', 3600, function () use ($posts) {
                return $posts;
            });
        }

        $greats_post_comment = Cache::get('greats_post_comment');
        $posts = Cache::get('posts');
        view()->share([
            'greats_post_comment' => $greats_post_comment,
            'posts' => $posts,
            'relatedsite' => $relatedsite,
            'categories' => $categories
        ]);
    }
}

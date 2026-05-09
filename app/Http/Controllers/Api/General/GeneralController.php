<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function getPosts()
    {
        $query = Post::query()->with(['user', 'category'])->activeUser()->activeCategory()->active();
        $posts = $query->get();
        $latest_post = $this->latestPosts($query);
        $most_read_posts = $this->most_read_posts($query);
        $oldest_news = $this->oldest_news($query);
        $popular_posts = $this->popular_posts($query);
        $categories = $this->categories();
        $category_with_posts = $this->category_with_posts($categories);

        return response()->json([
            'posts' => $posts,
            'latest_post' => $latest_post,
            'most_read_posts' => $most_read_posts,
            'popular_posts' => $popular_posts,
            'category_with_posts' => $category_with_posts,
            'oldest_news' => $oldest_news,

        ]);
    }


    public function latestPosts($query)
    {
        $latest_post = $query->latest()->take(4)->get();
        return $latest_post;
    }
    public function category_with_posts($categories)
    {
        $category_with_posts = $categories->map(function ($category) {
            $category->posts = $category->posts()->active()->limit(4)->get();
            return $category;
        });
        return $category_with_posts;
    }
    public function categories()
    {
        $categories = Category::has('posts')->activee()->get();
        return $categories;
    }
    public function most_read_posts($query)
    {
        $most_read_posts = $query->orderBy('numer_of_view', 'desc')->take(3)->get();

        return $most_read_posts;
    }
    public function oldest_news($query)
    {
        $oldest_news = $query->oldest()->take(3)->get();

        return $oldest_news;
    }
    public function popular_posts($query)
    {
        $popular_posts = $query->withCount('comment')->orderBy('comment_count', 'desc')->take(3)->get();

        return $popular_posts;
    }
}

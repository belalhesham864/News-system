<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function getPosts()
    {

        $query               = Post::query()->with(['user', 'category', 'admin', 'images'])->activeUser()->activeCategory()->active();
        $posts               = clone $query->orderBy('created_at', 'desc')->paginate(4);
        $latest_post         = $this->latestPosts(clone $query);
        $most_read_posts     = $this->most_read_posts(clone $query);
        $oldest_news         = $this->oldest_news(clone $query);
        $popular_posts       = $this->popular_posts(clone $query);
        $categories          = $this->categories();
        $category_with_posts = $this->category_with_posts($categories);
        $data = [
            'all_posts' => (new PostCollection($posts))->response()->getData(true),


            'latest_post' => new PostCollection($latest_post),
            'most_read_posts' => new PostCollection($most_read_posts),
            'popular_posts' => new PostCollection($popular_posts),
            'category_with_posts' => new CategoryCollection($category_with_posts),
            'oldest_news' => new PostCollection($oldest_news),
        ];
        return apiResponse(200, 'Success', $data);
    }


    public function latestPosts($query)
    {
        $latest_post = $query->latest()->take(4)->get();
        if (!$latest_post) {
            return apiResponse(404, 'Not Found');
        }
        return $latest_post;
    }
    public function category_with_posts($categories)
    {
        $category_with_posts = $categories->map(function ($category) {
            $category->posts = $category->posts()->active()->limit(4)->get();
            return $category;
        });
        if (!$category_with_posts) {
            return apiResponse(404, 'Not Found');
        }
        return $category_with_posts;
    }
    public function categories()
    {
        $categories = Category::has('posts')->activee()->get();
        if (!$categories) {
            return apiResponse(404, 'Not Found');
        }
        return $categories;
    }
    public function most_read_posts($query)
    {
        $most_read_posts = $query->orderBy('numer_of_view', 'desc')->take(3)->get();

        if (!$most_read_posts) {
            return apiResponse(404, 'Not Found');
        }
        return $most_read_posts;
    }
    public function oldest_news($query)
    {
        $oldest_news = $query->oldest()->take(3)->get();
        if (!$oldest_news) {
            return apiResponse(404, 'Not Found');
        }
        return $oldest_news;
    }
    public function popular_posts($query)
    {
        $popular_posts = $query->withCount('comment')->orderBy('comment_count', 'desc')->take(3)->get();
        if (!$popular_posts) {
            return apiResponse(404, 'Not Found');
        }
        return $popular_posts;
    }
}

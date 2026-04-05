<?php

namespace App\Http\Controllers\Forntend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('images')->latest()->paginate(9);
        $greats_view = Post::with('images')->orderBy('numer_of_view', 'desc')->limit(3)->get();
        // $oldest_news=Post::with('images')->orderBy('created_at','asc')->limit(3)->get();
        $oldest_news = Post::with('images')->oldest()->limit(3)->get();
        $greats_post_comment = Post::withCount('comment')->orderBy('comment_count', 'desc')->take(3)->get();
        // $category=Category::with('posts')->get();
        // dd($category);
        $categories=Category::all();
        $categories_with_posts=$categories->map(function ($category) {
            $category->posts =$category->posts()->limit(4)->get();
            return $category;
        });
        // dd($categories_with_posts);
        return view('forntend.index', compact('posts', 'greats_view', 'oldest_news','greats_post_comment','categories_with_posts'));
    }
}

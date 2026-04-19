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
      
        $greats_view = Post::active()->with('images')->orderBy('numer_of_view', 'desc')->limit(3)->get();
        // $oldest_news=Post::active()->with('images')->orderBy('created_at','asc')->limit(3)->get();
        $oldest_news = Post::active()->with('images')->oldest()->limit(3)->get();
        // $category=Category::with('posts')->get();
        // dd($category);
        $categories=Category::has('posts')->active()->get();

        $categories_with_posts=$categories->map(function ($category) {
            $category->posts =$category->posts()->active()->limit(4)->get();
            return $category;

        });
        // dd($categories_with_posts);
        return view('forntend.index', compact( 'greats_view', 'oldest_news','categories_with_posts'));
    }
}

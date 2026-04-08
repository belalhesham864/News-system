<?php

namespace App\Http\Controllers\Forntend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($slug)
    {
    $categories=Category::where('slug',$slug)->first();  
dd($slug, $categories);  
    $posts=$categories->posts()->paginate(9);

        return view('forntend.category_posts',compact('posts'));
    }
}

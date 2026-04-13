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
        
    $category=Category::where('slug',$slug)->first();  

    $posts=$category->posts()->latest()->paginate(9);

        return view('forntend.category_posts',compact('posts','category'));
    }
}

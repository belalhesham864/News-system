<?php

namespace App\Http\Controllers\Forntend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'search'=>'required|string|max:100'
        ]);
        $keyword=strip_tags($request->search);
        $posts = Post::active()->where('title', 'LIKE', '%' . $keyword . '%')
        ->orWhere('desc', 'Like', '%' . $keyword . '%')
        ->paginate(14);
     
        return view('forntend.searchPost',compact('posts','keyword'));
    }
}

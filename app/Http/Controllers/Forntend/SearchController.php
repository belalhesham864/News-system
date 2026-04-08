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
        $posts = Post::where('title', 'LIKE', '%' . $request->search . '%')
            ->orWhere('desc', 'Like', '%' . $request->search . '%')
            ->paginate(14);
        return view('forntend.searchPost',compact('posts'));
    }
}

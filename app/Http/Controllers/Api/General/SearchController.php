<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate(['keyword'=>'required|string|max:20']);
        $keyword=strip_tags($request->keyword);
        $search=Post::where('title','LIKE', '%'.$keyword. '%')->orWhere('desc','LIKE', '%'.$keyword. '%')->active()->activeCategory()->activeUser()->get();
        if($search->isEmpty()){
            return apiResponse(404,'Not Found post');
        }
        return apiResponse(200,'Success',new PostCollection($search));

    }
}

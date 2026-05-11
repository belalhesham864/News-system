<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
        public function showPost($slug){
        $post=Post::with(['admin','category','user','images'])->active()->activeUser()->activeCategory()->where('slug',$slug)->first();
      
        if(!$post){
            return apiResponse(404,'Not Found',);
            }
return apiResponse(200,'Success',new PostResource($post));
    }
}

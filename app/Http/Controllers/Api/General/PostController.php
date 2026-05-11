<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
        public function showPost($slug){
        $post=Post::active()->activeUser()->activeCategory()->where('slug',$slug)->first();
        if(!$post){
            return response()->json(['message'=>" post not found"],404);
            }
            return response()->json(['data'=>new PostResource($post)],200);
    }
}

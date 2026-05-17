<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getPosts(){
        $user=request()->user();
       $posts=$user->posts;
       if($posts->isEmpty()){
        return apiResponse(404,'Not post Found');
       }
       return apiResponse(200,'user posts',['posts'=>new PostCollection($posts)]);
    }
}

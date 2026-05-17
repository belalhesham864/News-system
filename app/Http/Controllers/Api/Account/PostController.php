<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PostRequest;
use App\Http\Resources\PostCollection;
use App\Models\Post;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function getPosts()
    {
        $user = request()->user();
        $posts = $user->posts->active()->activeCategory();
        if ($posts->isEmpty()) {
            return apiResponse(404, 'Not post Found');
        }
        return apiResponse(200, 'user posts', new PostCollection($posts));
    }
    public function createPost(PostRequest $request)
    {
        $request->validated();
        try {
            DB::beginTransaction();

            $user = $request->user();
            $request->merge(['user_id' => $user->id, 'slug' => Str::slug($request->title)]);
            $post = Post::create($request->except('images'));
            
            ImageManger::upload($request, $post, $user);
            DB::commit();
            Cache::forget('read_post_more');
            return apiResponse(201, 'Post Publicher Successfuly');
        } catch (\Exception $e) {

            DB::rollBack();
            Log::error('Error store user posr .' . $e->getMessage());
            return apiResponse(400, 'Please Try Again');
        }
    }
}

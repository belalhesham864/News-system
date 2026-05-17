<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PostRequest;
use App\Http\Requests\Forntend\PorfileRequest;
use App\Http\Resources\CommentCollection;
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
        $posts = $user->posts;
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
    public function getCommentPost($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        if (!$post) {
            return apiResponse(404, 'Not Found Post');
        }
        $comments = $post->comment()->get();
        if ($comments->count() > 0) {

            return apiResponse(200, 'Comment Post', new CommentCollection($comments));
        }
        return apiResponse(404, 'Not Comment FOUND');
    }
    public function UpdatedPost(PorfileRequest $request,$post_id){
        // return $post_id;
   $request->validated();
       $user=$request->user();
        $post=Post::where('id',$post_id)->first();
             if (!$post) {
            return apiResponse(404, 'Not Found Post');
        }
        $post->update($request->except('images'));
        ImageManger::delete($post);
        ImageManger::upload($request,$post,$user);

    return apiResponse(200, 'Post Updated Successfully', [
        'post' => $post
    ]);
    }
    public function destroy($post_id)
    {

        $post = Post::where('id', $post_id)->where('user_id', request()->user()->id)->first();
        if (!$post) {
            return apiResponse(404, 'Not Found');
        }

        ImageManger::delete($post);
        $post->delete();
        return apiResponse(200, 'Post Deleted Successfuly');
    }
}

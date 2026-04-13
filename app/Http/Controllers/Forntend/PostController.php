<?php

namespace App\Http\Controllers\Forntend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug)
    {
        $mainpost = Post::with(['comment'=>function($query){
            $query->latest()->limit(3);
        }])->whereSlug($slug)->first();
        $category = $mainpost->category;



        $belongstocategory = $category->posts()->select('id', 'title', 'slug')->latest()->limit(5)->get();
        $mainpost->increment('numer_of_view');
        return view('forntend.show_post', compact('mainpost', 'belongstocategory'));
    }
    public function getallcomment($slug){
   $post=post::active()->where('slug',$slug)->first();
   $comments=$post->comment()->with('user')->latest()->get();
 return response()->json($comments);
    }
    public function savecomment(Request $request){
       $request->validate([
        'user_id'=>'required|exists:users,id',
        'post_id'=>'required|exists:posts,id',
        'comment'=>'required|string|max:200',
       ]);
       $comment=Comment::create([
      'user_id'=>$request->user_id,
      'comment'=>$request->comment,
      'status'=>1,
      'post_id'=>$request->post_id,
      'ip_address'=>$request->ip(),
       ]);
       $comment=$comment->load('user');
       if(!$comment){
       return response()->json([
        'data'=>'Operation failed',
        'status'=>403
       ]);
       }else{
        return response()->json([
            'msg'=>'commented stored success',
            'data'=>$comment,
            'status'=>201
        ]);
       }
    }
}

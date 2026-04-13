<?php

namespace App\Http\Controllers\Forntend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Forntend\PorfileRequest;
use App\Models\Post;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use function Flasher\Prime\flash;

class porfilecontroller extends Controller
{
    public function index(){
        $postsuser=Post::active()->with('images')->where('user_id',auth()->user()->id)->get();
        return view('forntend.dashboard.pofile',compact('postsuser'));
    }
    public function store(PorfileRequest $request){
        try{
            DB::beginTransaction();
        $request->validated();
$request->comment_able=='on' ? $request->merge(['comment_able'=>1]):$request->merge(['comment_able'=>0]);
 $request->merge([
    'user_id'=>auth()->user()->id,
    'slug'=>str::slug($request->title),
 ]);

 $post=Post::create($request->except('images'));

ImageManger::upload($request,$post);
 DB::commit();
 Cache::forget('read_post_more');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['errors',$e->getMessage()]);

        }

 flash()->success('Your news has been published successfully');
 return redirect()->back();
        }

        public function edit($slug){
            $post=Post::where('slug',$slug)->first();
          
        }
      public function delete($id){
         $post=Post::where('id',$id)->first();
      if(!$post){
       abort(404);
      }
      if($post->images()->count()>0){
  foreach($post->images as $image){
    if((File::exists(public_path($image->path)))){
        File::delete(public_path($image->path));
    }
  }
      }
      $post->delete();
     flash()->success('post deleted successfully');
     return back();
      }
}

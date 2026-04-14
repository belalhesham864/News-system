<?php

namespace App\Http\Controllers\Forntend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Forntend\PorfileRequest;
use App\Models\Comment;
use App\Models\Image;
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
    public function index()
    {
        $postsuser = Post::active()->with('images')->where('user_id', auth()->user()->id)->get();
        return view('forntend.dashboard.pofile', compact('postsuser'));
    }
    public function store(PorfileRequest $request)
    {
        $request->validated();
        try {
            DB::beginTransaction();
       $this->Comment_Able($request);
            $request->merge([
                'user_id' => auth()->user()->id,
                'slug' => str::slug($request->title),
            ]);

            $post = Post::create($request->except('images'));

            ImageManger::upload($request, $post);
            DB::commit();
            Cache::forget('read_post_more');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['errors', $e->getMessage()]);
        }
        flash()->success('Your news has been published successfully');
        return redirect()->back();
    }
    public function edit($slug)
    {
        $post = Post::with('images')->where('slug', $slug)->first();
        if (! $post) {
            abort(404);
        }
        return view('forntend.dashboard.edit_post', compact('post'));
    }
    public function delete($id)
    {
        $post = Post::findOrFail($id);
       
        ImageManger::delete($post);
        $post->delete();
        flash()->success('post deleted successfully');
        return back();
    }
    public function getallcomment($id)
    {
        $comments = Comment::with(['user'])->where('post_id', $id)->get();
        if (!$comments) {
            return response()->json([
                'data' => null,
                'msg' => 'No comment'
            ]);
        }
        return response()->json([
            'data' => $comments
        ]);
    }
    public function update(PorfileRequest $request)
    {
        try{
            DB::beginTransaction();
         $request->validated();
        $post = Post::findOrFail($request->id);
      $this->Comment_Able($request);
        $post->update($request->except('images'));
        if ($request->hasFile('images')) {
            ImageManger::delete($post);
            ImageManger::upload($request, $post, null);
        }
        flash()->success('posted updated successfuly');
        DB::commit();
        return redirect()->route('forntend.dashboard.porfile');
        }catch(\Exception $e){
            DB::rollBack();
    return redirect()->back()->withErrors($e->getMessage());
        }
       
    }
    private function Comment_Able($request){
        return $request->comment_able == 'on' ? $request->merge(['comment_able' => 1]) : $request->merge(['comment_able' => 0]);
    }

    public function deletePostimage(Request $request, $image_id)
    {
        $image_id = $request->key;
        $image = Image::where('id', $image_id)->first();
        if (!$image) {
            return response()->json([
                'status' => 401,
                'msg' => 'image not found'
            ]);
        }
        if (File::exists(public_path($image->path))) {
            File::delete(public_path($image->path));
        }
        $image->delete();
        return response()->json([
            'status' => 200,
            'msg' => 'image deleted successfuly'
        ]);
    }
}

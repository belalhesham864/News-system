<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PostRequest;
use App\Http\Requests\Dashboard\UpdatePostRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function __construct() {
       $this->middleware('can:posts');
       $this->middleware('can:Create_Post')->only(['create','store']);
    }
    public function index()
    {
        $order_by = request()->order_by ?? 'asc';
        $Sort_By = request()->Sort_By ?? 'id';
        $limit = request()->limit ?? 5;

        $posts = Post::when(request()->search, function ($query) {
            $query->where('title', 'like', '%' . request()->search . '%');
        })->when(request()->status !== null, function ($query) {
            $query->where('status', request()->status);
        });
        $posts = $posts->orderBy($Sort_By, $order_by)->paginate($limit);
        // return $posts;
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorise = Category::select('id', 'name')->activee()->get();
        return view('admin.posts.create', compact('categorise'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try {

            $request->comment_able == 'on' ? $request->merge(['comment_able' => 1]) : $request->merge(['comment_able' => 0]);
            $request->merge([
                'slug' => Str::slug($request->title),
                'admin_id' => Auth::guard('admin')->id(),
            ]);
            $post = Post::create($request->except('images'));
            ImageManger::upload($request, $post, null);
            Cache::forget('read_post_more');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
        flash()->success('Your news has been published successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with('comment')->findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $categorise = Category::select('id', 'name')->activee()->get();
        return view('admin.posts.edit', compact('post', 'categorise'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        $request->validated();
        try {
            DB::beginTransaction();

            $post = Post::findOrFail($id);
            $request->comment_able == 'on' ? $request->merge([$request->comment_able == 1]) : $request->merge([$request->comment_able == 0]);
            $post->updated($request->except('images'));
            if ($request->hasFile('images')) {
                ImageManger::delete($post);
                ImageManger::upload($request, $post, null);
            }
            flash()->success('posted updated successfuly');
            DB::commit();
            return redirect()->route('admin.posts.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        ImageManger::delete($post);

        $post->delete();
        flash()->success("you deleted the post successfuly");
        return redirect()->back();
    }
    public function changestatus(string $id)
    {
        $post = Post::findOrFail($id);
        if ($post->status == 0) {
            $post->update([
                'status' => 1
            ]);
            flash()->success("you Actived the post successfuly");
        } else {
            $post->update([
                'status' => 0
            ]);
            flash()->success("you deactivate the post successfuly");
        }
        return redirect()->route('admin.posts.index');
       
    }
    public function deleteimage($id)
    {
        $image = Image::where('id', $id)->first();
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
    public function deletecomment($id){
       $comment= Comment::findOrFail($id);
       $comment->delete();
       flash()->success('the comment deleted successfuly');
       return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Utils\ImageManger;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
        return redirect()->back();
    }
    
}

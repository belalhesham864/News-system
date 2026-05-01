<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use function Flasher\Prime\flash;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('can:categories');
    }
    public function index()
    {
        $order_by = request()->order_by ?? 'asc';
        $Sort_By = request()->Sort_By ?? 'id';
        $limit = request()->limit ?? 5;

        $Categories = Category::withCount('posts')->when(request()->search, function ($query) {
            $query->where('name', 'like', '%' . request()->search . '%');
        })->when(request()->status !== null, function ($query) {
            $query->where('status', request()->status);
        });
        $Categories = $Categories->orderBy($Sort_By, $order_by)->paginate($limit);
        return view('admin.categories.index', compact('Categories'));
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
        $request->validate([
            'name' => 'required|string|min:3|unique:categories,name',
            'SmallDesc' => 'required|string|min:10',
            'status' => 'required|in:1,0'
        ]);
        $request->merge([
            'slug' => Str::slug($request->name),

        ]);


        $category = Category::create($request->all());
        if (!$category) {

            flash()->error('Please Try Again');
            return redirect()->back();
        }
        flash()->success("you Category Created successfuly");
        return redirect()->back();
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
        $request->validate([
            'name' => 'required|string|min:3|unique:categories,name,'.$id,
            'SmallDesc' => 'required|string|min:10',
            'status' => 'required|in:1,0'
        ]);
        $request->merge([
            'slug' => Str::slug($request->name),

        ]);
        $category = Category::findOrFail($id);
        if (!$category) {

            flash()->error('Category Not Found');
            return redirect()->back();
        }
        $category->update($request->all());
        flash()->success("you Category Updated successfuly");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Category = Category::findOrFail($id);

        $Category->delete();
        flash()->success("you delete the Category successfuly");
        return redirect()->back();
    }
    public function changestatus(string $id)
    {
        $Category = Category::findOrFail($id);
        if ($Category->status == 0) {
            $Category->update([
                'status' => 1
            ]);
            flash()->success("you Actived the Category successfuly");
        } else {
            $Category->update([
                'status' => 0
            ]);
            flash()->success("you deactivate the Category successfuly");
        }
        return redirect()->back();
    }
}

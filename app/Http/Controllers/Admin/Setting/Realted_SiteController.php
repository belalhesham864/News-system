<?php

namespace App\Http\Controllers\Admin\setting;

use App\Http\Controllers\Controller;
use App\Models\RelatedNewsSite;
use Illuminate\Http\Request;

class Realted_SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Realted_site=RelatedNewsSite::select('name','url','id','created_at')->get();
return view('admin.Related_site.index',compact('Realted_site'));
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
$request->validate(['name'=>'required|min:5','url'=>'required|url']);
 $site=RelatedNewsSite::create($request->all());
if(!$site){
    flash()->error('Please Try again');
    return redirect()->back();
}
flash()->success('Realted Site Created Successfuly');
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
        $request->validate(['name'=>'required|min:5','url'=>'required|url']);

        $site=RelatedNewsSite::findOrFail($id);
        $site->update($request->all());
        flash()->success('Related Site Updated Successfuly');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $site=RelatedNewsSite::findOrFail($id);
        $site->delete();
        flash()->success('Related Site Deleted successfuly');
        return redirect()->back();
    }
}

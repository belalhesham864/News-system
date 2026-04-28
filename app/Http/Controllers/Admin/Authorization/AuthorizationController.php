<?php

namespace App\Http\Controllers\Admin\Authorization;

use App\Http\Controllers\Controller;
use App\Models\Authorization;
use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.authorization.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:5|unique:authorizations,role',
            'permision'=>'required|min:1',
        ]);
      $auth=new Authorization();
      $auth->role=$request->name;
      $auth->permessions=json_encode($request->permision);
      $auth->save();
      flash()->success('Role Add Successfuly');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

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
        $authorization=Authorization::paginate(5);

        // return $authorization;
        return view('admin.authorization.index',compact('authorization'));
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
      $this->Roles($request,$auth);
      flash()->success('Role Add Successfuly');
      return redirect()->route('admin.authorization.index');

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
         $role=Authorization::findOrFail($id);
         
         return view('admin.authorization.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
              $request->validate([
            'name'=>'required|min:5|unique:authorizations,role,'.$id,
            'permision'=>'required|min:1',
        ]);

        $auth=Authorization::findOrFail($id);
       
       $this->Roles($request,$auth);
        flash()->success('Role Updated Successfuly');
        return redirect()->route('admin.authorization.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role=Authorization::findOrFail($id);
        if($role->admins->count()>0){
              flash()->warning('Please Delete Related Admin First!!');
              return redirect()->back();
        }
        $role->delete();
        flash()->success('You deleted the role successfuly!!');
        return  redirect()->route('admin.authorization.index');

    }
    private function Roles($request,$auth){
         $auth->role=$request->name;
      $auth->permessions=json_encode($request->permision);
      $auth->save();
    }
}

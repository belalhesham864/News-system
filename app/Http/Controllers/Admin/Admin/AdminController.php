<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Authorization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Flasher\Prime\flash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        $this->middleware('can:admins');

    }
    public function index()
    {
              $order_by = request()->order_by ?? 'asc';
        $Sort_By = request()->Sort_By ?? 'id';
        $limit = request()->limit ?? 5;

        $admins = Admin::where('id','!=',Auth::guard('admin')->id())->when(request()->search, function ($query) {
            $query->where('name', 'like', '%' . request()->search . '%')->orWhere('email', 'like', '%' . request()->search . '%');
        })->when(request()->status !== null, function ($query) {
            $query->where('status', request()->status);
        });
        $admins = $admins->orderBy($Sort_By, $order_by)->paginate($limit);
        return view('admin.admins.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles=Authorization::select('id','role')->get();
        return view('admin.admins.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $data=$request->validate([
            'name'=>'required|string|max:50',
            'username'=>'required|string|max:60',
            'status'=>'required',
            'email'=>'required|email|max:50|unique:admins,email',
            'password'=>'required|confirmed',
            'role_id'=>'required',
        ]);

        
        $data['password']=Hash::make($request->password);
      $admin=Admin::create($data);
if(!$admin){
    
      flash()->error('Please try again');
        return redirect()->back();
}
      flash()->success('Admin Created Successfuly');
        return redirect()->route('admin.admins.index');

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin=Admin::findOrFail($id);
        return view('admin.admins.show',compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin=Admin::findOrFail($id);
          $roles=Authorization::select('id','role')->get();
        return view('admin.admins.edit',compact('admin','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
        $request->validate([
            'name'=>'required|string|max:50',
            'username'=>'required|string|max:60|unique:admins,username,'.$id,
            'status'=>'required',
            'email'=>'required|email|max:50|unique:admins,email,'.$id,
            'password'=>'nullable|confirmed',
            'role_id'=>'required',
        ]);
        $data=$request->except('password');
        $admin=Admin::findOrFail($id);
        if($request->filled('password')){
             $data['password']=hash::make($request->password);
            }
        $admin->update($data);
           flash()->success('Admin updated Successfuly');
        return redirect()->route('admin.admins.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          $admin=Admin::findOrFail($id);
          $admin->delete();
           flash()->success("you Delete the admin successfuly");
             return redirect()->route('admin.admins.index');
    }
        public function changestatus(string $id)
    {
        $admin = Admin::findOrFail($id);
        
        if ($admin->status == 0) {
            $admin->update([
                'status' => 1
            ]);
            flash()->success("you Actived the admin successfuly");
        } else {
            $admin->update([
                'status' => 0
            ]);
            flash()->success("you deactivate the admin successfuly");
        }
        return redirect()->route('admin.admins.index');
       
    }
}

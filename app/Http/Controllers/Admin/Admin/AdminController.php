<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
              $order_by = request()->order_by ?? 'asc';
        $Sort_By = request()->Sort_By ?? 'id';
        $limit = request()->limit ?? 5;

        $admins = Admin::when(request()->search, function ($query) {
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
        //
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

<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserRequest;
use App\Models\User;
use App\Utils\ImageManger;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use function Flasher\Prime\flash;
use function Symfony\Component\Clock\now;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return request();
        $order_by = request()->order_by ?? 'asc';
        $Sort_By = request()->Sort_By ?? 'id';
        $limit = request()->limit ?? 5;

        $users = User::when(request()->search, function ($query) {
            $query->where('name', 'like', '%' . request()->search . '%')->orWhere('email', 'like', '%' . request()->search . '%');
        })->when(request()->status !== null, function ($query) {
            $query->where('status', request()->status);
        });
        $users = $users->orderBy($Sort_By, $order_by)->paginate($limit);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
     $request->validated();
  
        $request->merge([
        'email_verified_at' => $request->email_verified_at == 1 ? Carbon::now()->toDateTimeString() : null,
        'password' => bcrypt($request->password),
    ]);
       
       $user=User::create($request->except(['image','password_confirmation']));
     ImageManger::upload($request,null,$user);
     flash()->success('User added successfuly');
     return redirect()->back();
    }
                
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $id;
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
        $user = User::findOrFail($id);
        if (File::exists(public_path($user->image))) {
            File::delete(public_path($user->image));
        }
        $user->delete();
        flash()->success("you delete the user successfuly");
        return redirect()->back();
    }
    public function userBlock($id)
    {
        $user = User::findOrFail($id);
        if ($user->status == 0) {
            $user->update([
                'status' => 1
            ]);
            flash()->success("you Actived the user successfuly");
        } else {
            $user->update([
                'status' => 0
            ]);
            flash()->success("you Blocked the user successfuly");
        }
        return redirect()->back();
    }
}

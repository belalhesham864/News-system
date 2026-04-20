<?php

namespace App\Http\Controllers\Admin\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function Flasher\Prime\flash;

class ResetPassworController extends Controller
{
    public function showform($email){
return view('admin.auth.password.reset',['email'=>$email]);
    }
    public function resetPassword(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|confirmed|min:8'
        ]);
    
        $admin=Admin::where('email',$request->email)->first();
        if(!$admin){
            return redirect()->back()->with(['error'=>'please try again']);
        }

        $admin->update([
            'password'=>Hash::make($request->password),
        ]);
        flash()->success('password changed successfuly');
        return redirect()->route('admin.login.show');
    }

}

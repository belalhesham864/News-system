<?php

namespace App\Http\Controllers\Admin\Porfile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PorfileAdminRequest;
use App\Models\Admin;
use App\Models\Authorization;
use App\Notifications\UpdatePorfileAdmin;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PorfileController extends Controller
{
    public function index(){
        $id=Auth::guard('admin')->id();
$admin=Admin::findOrFail($id);

return view('admin.porfile.index',compact('admin'));
    }


    public function SendOtp(PorfileAdminRequest $request,$id){
        $request->validated();
        session()->put('update',$request->except(['_token','_method']));
      $admin=Admin::findOrFail($id);
      $admin->notify(new UpdatePorfileAdmin());
        return view('admin.porfile.OtpUpdte',['email'=>$admin->email]);
    }
    public function verifayotp(Request $request){
 
  $request->validate([
    'email'=>'required|exists:admins,email',
    'code'=>'required|min:5',
  ]);

  $otp=new Otp();
 $check= $otp->validate($request->email,$request->code);
  if($check->status==false){
 return redirect()->back()->withErrors(['code'=>'Otp is invailed!']);
  }
$data=session('update');
$admin=Admin::where('email',$request->email)->first();

   $admin->update([
  'name'=>$data['name'],
  'username'=>$data['username'],
  'email'=>$data['email'],
  
   ]);
flash()->success('porfile Updated Successfuly');
return redirect()->route('admin.porfile.index');
  }
public function ChangePassword(){
    $admin=Admin::findOrFail(Auth::guard('admin')->id());
    return view('admin.porfile.ChangePassword', compact('admin'));
}
public function UpdatePassword(Request $request,$id){
    $request->validate([
        'password_current'=>'required',
        'password'=>'required|min:8|confirmed',
        'password_confirmation'=>'required',
    ]);
    $admin=Admin::findOrFail($id);
    if(!Hash::check($request->password_current,$admin->password)){
        flash()->error('Current Password Is Invailed');
        return redirect()->back();
    }
  $admin->update(['password'=>Hash::make($request->password)]);
  flash()->success('Password Updated Successfuly');
  return redirect()->route('admin.porfile.index');

}

}

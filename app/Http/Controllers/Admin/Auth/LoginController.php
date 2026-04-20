<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Flasher\Prime\flash;

class LoginController extends Controller
{

    public function showloginform(){
  return view('admin.auth.login');
    }
    public function checkauth(Request $request){
  
   $request->validate([
    'email'=>'required|email',
    'password'=>'required',
    'remberme'=>'in:on,off'
   ]);
   $rember=$request->remberme=='on';
  
  $user=Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$rember);
  
  if(!$user){
    return redirect()->back()->withErrors(['email'=>'Credentials do not match']);
  }
  $request->session()->regenerate();
    flash()->success("welcome mr : ".auth('admin')->user()->name);
    return redirect()->route('admin.home');
  
    }
    public function logout(Request $request){
    Auth::guard('admin')->logout();
    flash()->warning('your logedout');
    return redirect()->route('admin.login.show');
    }
}

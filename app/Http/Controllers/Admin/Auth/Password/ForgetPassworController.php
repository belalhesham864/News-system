<?php

namespace App\Http\Controllers\Admin\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\SendOtpNotifay;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;

class ForgetPassworController extends Controller
{
    public $Otb2;
    public function __construct()
    {
       $this->Otb2=new Otp();
    }
    public function showEmailForm(){
        return view('admin.auth.password.email');
    }
    public function sendotp(Request $request){
       $request->validate([
        'email'=>'required|email|exists:admins,email'
       ]);
      $admin=Admin::where('email',$request->email)->first();
      $admin->notify(new SendOtpNotifay());
      return redirect()->route('admin.password.showOtpForm',['email'=>$admin->email]);
    }
    public function showOtpForm($email){
       
        return view('admin.auth.password.confirm',['email'=>$email]);
    }
    public function verifayOtp(Request $request){
        
        $request->validate([
            'email'=>'required|email',
            'code'=>'required|min:5'
        ]);
     $otp=$this->Otb2->validate($request->email,$request->code);
    if($otp->status==false){
        return redirect()->back()->withErrors(['code'=>'Otp is invailed!']);
    }  
return redirect()->route('admin.password.showformReset',['email'=>$request->email]);
    }
}

<?php

namespace App\Http\Controllers\Api\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\Api\SendOtpResetPassword;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    public $otp;
    public function __construct()
    {
        $this->otp=new Otp();
    }
    public function sendotp(Request $request){
         $request->validate(['email'=>'required|email|exists:users,email|max:30']);
         $user=User::where('email',$request->email)->first();
         if(!$user){
            return apiResponse(404,'Not Found');
         }
         $user->notify(new SendOtpResetPassword());
         return apiResponse(200,'Otp Send Successfuly , Check Your Email');
    }
    public function checkotp(Request $request){
       $request->validate(['code'=>'required|max:7','email'=>'required|email|max:30']);
    $check= $this->otp->validate($request->email,$request->code);
        if($check->status==false){
            return apiResponse(400,'Token invailed');
        }
        return apiResponse(200,'Token Check Success , Reset your password');
    }
    
}

<?php

namespace App\Http\Controllers\Api\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function resetPassword(Request $request){
         $request->validate(['password'=>"required|min:8|confirmed",'email'=>'required|email|exists:users,email']);
      $user=User::where('email',$request->email)->first();
      $user->update(['password'=>Hash::make($request->password)]);
      if(!$user){
        return apiResponse(400,'Please Try Again');
      }
      return apiResponse(200,'Password Changed Successfuly');
    }
}

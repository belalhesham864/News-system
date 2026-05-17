<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserRequest;
use App\Models\User;
use App\Notifications\Api\SendOtpRegister;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function register(UserRequest $request){
         $request->validated();
         try{
            DB::beginTransaction();
              $user=User::create($request->except('password_confirmation','image'));
              
         if(!$user){
            return apiResponse(404,'Please Try Again');
         }
           $user->notify(new SendOtpRegister());
      
if($request->hasFile('image')){
        ImageManger::upload($request,null,$user);
}
         $token=$user->createToken('auth-registet')->plainTextToken;
       
         DB::commit();
         return apiResponse(201,'Register Sucess',['user'=>$user,'token'=>$token]);
         }catch(\Exception $e){
DB::rollBack();
         Log::error('Error From Regisration'.$e->getMessage());
         return apiResponse(500,'Inrenal Server Error');
         }
       
    }
}

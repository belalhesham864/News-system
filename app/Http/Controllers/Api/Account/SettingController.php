<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Forntend\SettingRequest;
use App\Models\User;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function updateSetting(SettingRequest $request){
            $request->validated();
     $user=$request->user();
     if(!$user){
        return apiResponse(404,'Not Found');
     }
     $user->update($request->except('image'));
     ImageManger::upload($request,null,$user);
     return apiResponse(200,'User updated Successfuly');
    }

    public function changePassword(Request $request){
        $request->validate([
            'current_password'=>'required',
            'password'=>'required|confirmed|min:8'
            ]);
        $user=$request->user();
           if(!$user){
        return apiResponse(404,'Not Found');
     }
        if(!Hash::check($request->current_password,$user->password)){
 return apiResponse(400,'Current password is invailed');
        }
        $newpass=$user->update([
            'password'=>Hash::make($request->password)
            ]);
        if(!$newpass){
             return apiResponse(400,'warring please try again ');

        }
        return apiResponse(200,'Password Change Successfuly');

    }
}

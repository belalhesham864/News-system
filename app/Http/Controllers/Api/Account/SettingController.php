<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Forntend\SettingRequest;
use App\Models\User;
use App\Utils\ImageManger;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function updateSetting(SettingRequest $request,$user_id){
            $request->validated();
     $user=User::find($user_id);
     if(!$user){
        return apiResponse(404,'Not Found');
     }
     $user->update($request->except('image'));
     ImageManger::upload($request,null,$user);
     return apiResponse(200,'User updated Successfuly');
    }
}

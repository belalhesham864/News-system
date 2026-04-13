<?php

namespace App\Http\Controllers\Forntend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Forntend\SettingRequest;
use App\Models\Post;
use App\Utils\ImageManger;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use function Flasher\Prime\flash;

class SettingController extends Controller
{
    public function getsetting(){
        $user=auth()->user();
       
       return view('forntend.dashboard.setting',compact('user'));
    }
    public function update (SettingRequest $request){
  
     $request->validated();
     $user=auth()->user();
     $user->update($request->except('image'));
     ImageManger::upload($request,null,$user);
     flash()->success('Porfile Updated Successfuly');
     return redirect()->back();
    }
    public function changepassword(Request $request){
       $request->validate([
        'current_password'=>'required',
        'new_password'=>'required|between:8,16|string|confirmed',
    
       ]);
       $user=auth()->user();
       if(!Hash::check($request->current_password,$user->password)){
      flash()->error('Password dosent match');
      return redirect()->back();
       }
       
       $user->update([
        'password'=>Hash::make($request->new_password)
       ]);
       flash()->success('password chancged sucessfuly');
       return redirect()->back();
      
    }
}

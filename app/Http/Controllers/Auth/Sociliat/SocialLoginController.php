<?php

namespace App\Http\Controllers\Auth\Sociliat;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect(){
     return Socialite::driver('google')->redirect();
    }
    public function callback(){
        $google=Socialite::driver('google')->user();
      $user=User::updateOrCreate(['email'=>$google->getEmail(),'google_id'=>$google->getId()],[
        'name'=>$google->getName(),
        'email'=>$google->getEmail(),
        'google_id'=>$google->getId(),
       
        'username'=>Str::slug($google->getName()).time(),
        'image'=>$google->getAvatar(),
        'country'=>'undefined',
        'city'=>'undefined',
        'street'=>'undefined',
        'phone'=>'undefine',
        'email_verified_at'=>now(),
        'password'=>Hash::make(Str::random(8))
        
      ]);
      Auth::login($user);
      flash()->success('Welcome Mr' .$user->name);
      return redirect()->route('forntend.index');
    }
}

<?php

namespace App\Http\Controllers\Auth\Sociliat;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($porvider){
        
     return Socialite::driver($porvider)->redirect();
    }
    public function callback($porvider){

      try{
        DB::beginTransaction();
        $user=Socialite::driver($porvider)->user();
      
 
      $user_db=User::updateOrCreate(['email'=>$user->getEmail()],[
        'name'=>$user->getName(),
        'email'=>$user->getEmail(),
        'google_id'=>$user->getId(),
       
        'username'=>Str::slug($user->getName()).time(),
        'image'=>$user->getAvatar(),
        'country'=>'undefined',
        'city'=>'undefined',
        'street'=>'undefined',
        'phone'=>'undefined',
        'email_verified_at'=>now(),
        'password'=>Hash::make(Str::random(8))

        
      ]);
      Auth::login($user_db);
      flash()->success('Welcome Mr ' .$user_db->name);
      DB::commit();
      return redirect()->route('forntend.index');
       }catch(\Exception $e){
     DB::rollBack();
     return redirect()->route('login');
       }
    }
}

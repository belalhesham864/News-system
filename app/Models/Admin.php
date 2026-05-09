<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
    // protected $guarded = [];
    protected $fillable = ['id','name','password','email','username','status','role_id'];
        protected $hidden = [
        'password',
        'remember_token',
    ];
        protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
     public function posts(){
        return $this->hasMany(Post::class,'admin_id');
    }
public function role()
{
    return $this->belongsTo(Authorization::class, 'role_id');
}
public function hasAcess($config_permesion){
    $authorizaton=$this->role;
    if(!$authorizaton){
        return false;
    }
    foreach($authorizaton->permessions  as $permesion){
    if($config_permesion == $permesion){
return true;
    }
    }
}



    public function receivesBroadcastNotificationsOn(): string
    {
        return 'admins.'.$this->id;
    }
        public function status(){
return $this->status==1 ? 'Active' : 'Not Active';
    }
}

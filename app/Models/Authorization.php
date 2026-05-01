<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Authorization extends Model
{
    protected $guarded = [];
    public function getpermessionsAttribute($permessions){
  return json_decode($permessions);
    }
public function admins(){
  return $this->hasMany(Admin::class,'role_id');
}
}

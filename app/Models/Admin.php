<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    // protected $guarded = [];
    protected $fillable = ['id','name','password','email','username'];
}

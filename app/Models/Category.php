<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    public function posts(){
        return $this->hasMany(Post::class,'category_id');
    }
     public function scopeActivee($query){
      $query->where('status',1);
    }

}

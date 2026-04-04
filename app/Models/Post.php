<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
        protected $guarded = [];
  public function category(){
    return $this->belongsTo(Category::class,'category_id');
  }
  public function user(){
    return $this->belongsTo(User::class,'user_id');
  }
  public function comment(){
    return $this->hasMany(Comment::class,'post_id');
  }
  public function images(){
    return $this->hasMany(Image::class,'post_id');
  }
}

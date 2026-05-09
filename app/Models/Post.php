<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  use HasFactory,Sluggable;
        protected $guarded = [];
        
  public function category(){
    return $this->belongsTo(Category::class,'category_id');
  }
  public function user(){
    return $this->belongsTo(User::class,'user_id');
  }
  public function admin(){
    return $this->belongsTo(Admin::class,'admin_id');
  }
  public function comment(){
    return $this->hasMany(Comment::class,'post_id');
  }
  public function images(){
    return $this->hasMany(Image::class,'post_id');
  }
      public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    
    public function scopeActive($query){
      $query->where('status',1);
    }
    public function scopeActiveUser($query){
    $query->where(function($query){
        $query->whereHas('user',function($user) {
        $user->where('status',1);
      });
    })->orwhere('user_id',null);
    }
    public function scopeActiveCategory($query){
      $query->whereHas('category',function($category) {
        $category->where('status',1);
      });
    }


    public function status(){
return $this->status==1 ? 'Active' : 'Not Active';
    }
    public function comment_able(){
      return $this->comment_able==1 ? 'Active' : 'Not Active';
    }
}

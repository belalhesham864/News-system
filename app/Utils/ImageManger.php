<?php

namespace App\Utils;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageManger{
    public static function upload($request,$post){
         if($request->hasFile('images')){
    foreach($request->images as $image){
        $imagename= str::uuid(). time(). ".". $image->getClientOriginalExtension();
        $path=$image->storeAs('uploads/news', $imagename,['disk'=>'uploads']);
        $post->images()->create([
            'path'=>$path,
        ]);
    }
    }}
    public static function delete($post){
              if($post->images()->count()>0){
  foreach($post->images as $image){
    if((File::exists(public_path($image->path)))){
        File::delete(public_path($image->path));
    }
  }
      }
    }
    
}
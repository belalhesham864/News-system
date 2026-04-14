<?php

namespace App\Utils;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageManger{
    // uploads multi images
    public static function upload($request,$post=null,$user=null){
         if($request->hasFile('images')){
    foreach($request->images as $image){
        $filename= self::genratename($image);
        $path=$image->storeAs('uploads/news', $filename,['disk'=>'uploads']);
        $post->images()->create([
            'path'=>$path,
        ]);
    }
    }
           if($request->hasFile('image')){
        if(File::exists(public_path($user->image))){
            File::delete(public_path($user->image));
        }
        $image=$request->file('image');
         $filename= self::genratename($image);
        $path=$image->storeAs('uploads/users',$filename,['disk'=>'uploads']);
        $user->update(['image'=>$path]);

     }
    
    
    }
    public static function delete($post){
              if($post->images()->count()>0){
  foreach($post->images as $image){
    if(File::exists(public_path($image->path))){
        File::delete(public_path($image->path));
    }
    $image->delete();
  }
      }
    }
    private static function genratename($image){
$filename=str::uuid().time().'.'. $image->getClientOriginalExtension();
return $filename;
    }

  
    
}
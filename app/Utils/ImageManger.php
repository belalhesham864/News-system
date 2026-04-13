<?php

namespace App\Utils;
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
    }
    }
}
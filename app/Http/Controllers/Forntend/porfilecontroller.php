<?php

namespace App\Http\Controllers\Forntend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Forntend\PorfileRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use function Flasher\Prime\flash;

class porfilecontroller extends Controller
{
    public function index(){
        return view('forntend.dashboard.pofile');
    }
    public function store(PorfileRequest $request){
        try{
            DB::beginTransaction();
        $request->validated();
$request->comment_able=='on' ? $request->merge(['comment_able'=>1]):$request->merge(['comment_able'=>0]);
 $request->merge([
    'user_id'=>auth()->user()->id,
    'slug'=>str::slug($request->title),
 ]);

 $post=Post::create($request->except('images'));

 if($request->hasFile('images')){
    foreach($request->images as $image){
        $imagename= $post->slug . time(). ".". $image->getClientOriginalExtension();
        $path=$image->storeAs('uploads/news', $imagename,['disk'=>'uploads']);
        $post->images()->create([
            'path'=>$path,
        ]);
    }
 }
 DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['errors',$e->getMessage()]);

        }

 flash()->success('Your news has been published successfully');
 return redirect()->back();
        }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       
            $data=[
      
            'title'=>$this->title,
            'slug'=>$this->slug,
            'numer_of_views'=>$this->numer_of_view,
            'status'=>$this->status(),
            'media'=> new ImageCollection($this->images),
       'post_url'=>route('forntend.post.show',$this->slug),
            'Date'=>$this->created_at->diffForHumans(),
            'Publisher'=> $this->user_id==null ? new AdminResource($this->admin) : new UserResource($this->user),
                        ];

           
            // 'Publisher_name'=>$this->admin->name ?? $this->user->name,
            // 'User'=> new UserResource($this->user),
            // 'Admin'=> new AdminResource($this->admin),
    


            if($request->is('api/post/show/*')){
                $data['comment_able']=$this->comment_able();
                $data['Description']=$this->desc;
                $data['small_desc']=$this->SmallDesc;
                // $data['comment']=new CommentCollection($this->comment);
                $data['category']=new CategoryResource($this->category);
                }
                return $data;
    }
}


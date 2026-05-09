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
        return [
            'title'=>$this->title,
            'slug'=>$this->slug,
            'Description'=>$this->desc,
            'numer_of_views'=>$this->numer_of_view,
             'comment_able' =>$this->comment_able(),
            //  'status'=>$this->status==1 ? 'Active' :'Not Active',
             'status'=>$this->status(),
              'small_desc'=>$this->SmallDesc,
            'Date'=>$this->created_at->diffForHumans(),


            'category'=>new CategoryResource($this->category),
            'Publisher'=> $this->user_id==null ? new AdminResource($this->admin) : new UserResource($this->user),
            // 'Publisher_name'=>$this->admin->name ?? $this->user->name,
            // 'User'=> new UserResource($this->user),
            // 'Admin'=> new AdminResource($this->admin),
        ];
    }
}


<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotifactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'type'=>$this->type,
            'username'=>$this->data['username'],
            'post title'=>$this->data['post_title'],
            'comment'=>$this->data['comment'],
            'link'=>route('api.posts.show',$this->data['post_slug']).'?notify='.$this->id   ,
           "Date"=> $this->created_at->diffForHumans()

        ];
    }
}

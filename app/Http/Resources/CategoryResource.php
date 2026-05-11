<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Category_name'=>$this->name,
            'Category_slug'=>$this->slug,
            'status'=>$this->status(),
            'Date'=>$this->created_at->diffForHumans(),
            'posts'=>new PostCollection($this->posts)
        ];
    }
}

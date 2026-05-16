<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'User_name'=>$this->name,
            'User_image'=>asset($this->image),
            'User_status'=>$this->status(),
            'Created_date'=>$this->created_at->format('y-m-d h:m a')
        ];
    }
}

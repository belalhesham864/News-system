<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

        'site_name'=>$this->site_name,
        'email'=>$this->email,
        'phone'=>$this->phone,
        'favicon'=>asset($this->favicon),
        'logo'=>asset($this->logo),
        'facebook'=>$this->facebook,
        'tiwter'=>$this->tiwter,
        'instgram'=>$this->instgram,
        'youtube'=>$this->youtube,
        'address'=>$this->street .','. $this->city .','. $this->country,
   
        
        'contact'=>$this->contact,
        'SmallDesc'=>$this->SmallDesc,
        'Date'=>$this->created_at->diffForHumans(),
        ];

    }
}


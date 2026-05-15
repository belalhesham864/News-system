<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Resources\RelatedNewsCollection;
use App\Http\Resources\SettingResource;
use App\Models\RelatedNewsSite;
use App\Models\Setting;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getsetting()
    {
        $setting = Setting::first();
        $relatedsite = $this->RelatedSite();

        if (!$setting) {
            return apiResponse(404, 'Not Found');
        }
        $data=['setting'=>new SettingResource($setting),
        'related_site'=>$this->RelatedSite()
        ];

        return apiResponse(200, 'Success', $data );
    }
    private function RelatedSite()
    {
        $relatedsite = RelatedNewsSite::select('name', 'url')->get();
        if (!$relatedsite) {
            return apiResponse(404, 'Not Found');
        }
        return $relatedsite;
    }
}

<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Resources\RelatedNewsCollection;
use App\Models\RelatedNewsSite;
use Illuminate\Http\Request;

class RelatedNewsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $related_news=RelatedNewsSite::get();
        if(!$related_news){
            return apiResponse(404,'Not Found');
        }
        return apiResponse(200,new RelatedNewsCollection($related_news));
    }
}

<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\Forntend\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ContactRequest $request)
    {
         $request->validated();
         $request->merge(['ip_address'=>$request->ip()]);
         $contact=Contact::create($request->all());
        if(!$contact){
            return apiResponse(404,'Not Found');
        }else{
            return apiResponse(200,'Contact send successfuly');
        }
    }
}

<?php

namespace App\Http\Controllers\Forntend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Forntend\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index(){
        return view('forntend.contact-us');
    }
    public function store(ContactRequest $request){
      $request->validated();
      $request->merge([
        'ip_address'=>$request->ip()
      ]);
    $contact=Contact::create($request->all());
    if(!$contact){
           flash()->error('contact-us failed ');
                 return redirect()->back();

    }
      flash()->success('Thank you for contacting us!
We have received your message and will get back to you as soon as possible.');
      return redirect()->back();
    }
}

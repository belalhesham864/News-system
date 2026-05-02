<?php

namespace App\Http\Controllers\Forntend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Forntend\ContactRequest;
use App\Models\Admin;
use App\Models\Contact;
use App\Notifications\NewContactNotifaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

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
    $admins=Admin::get();
// foreach($admins as $admin){

//   $admin->notify(new NewContactNotifaction($contact));
//   }
Notification::send($admins,new NewContactNotifaction($contact));
      flash()->success('Thank you for contacting us!
We have received your message and will get back to you as soon as possible.');
      return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Forntend;

use App\Http\Controllers\Controller;
use App\Mail\forntend\newsubscriber;
use App\Mail\forntend\newsubscriberMail;
use App\Models\NewsSubscrriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use function Flasher\Prime\flash;

class NewsSubscrriberController extends Controller
{
    public function store(Request $request){
    $request->validate(['email'=>'required|email|unique:news_subscrribers']);
    $NewsSubscrriber=NewsSubscrriber::create([
        'email'=>$request->email
    ]);


    if(!$NewsSubscrriber){
        flash()->error('error , please try again');
        return redirect()->back();
    }
    $email=$request->email;
Mail::to($email)->send(new newsubscriberMail());
    flash()->success('Subscribed to the latest news successfully');
            return redirect()->back();
    }
}

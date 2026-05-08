<?php

namespace App\Http\Controllers\Admin\Notifications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:notifaction');
    }
    public function index(){
       Auth::guard('admin')->user()->unreadNotifications->markAsRead();
        $notifaction=Auth::guard('admin')->user()->notifications()->get();
       
        return view('admin.notifications.index',compact('notifaction'));
    }

    public function delete($id){
        $notifay=Auth::guard('admin')->user()->notifications()->where('id',$id)->first();
        $notifay->delete();
        flash()->success('Notification deleted successfuly');
        return redirect()->back();
    }
    public function deleteAll(){
        $notifaction=Auth::guard('admin')->user()->notifications()->get();
        foreach($notifaction as $notifay){

            $notifay->delete();
        }
        flash()->success(' All Notification deleted successfuly');
        return redirect()->back();
    }
}

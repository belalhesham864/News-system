<?php

namespace App\Http\Controllers\Forntend\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use function Flasher\Prime\flash;

class NotifactionController extends Controller
{
    public function index(){
        return view('forntend.dashboard.notifaction');
    }
    public function readall(){
        auth()->user()->unreadNotifications->markAsRead();
                flash()->success('all notifaction readed');

        return redirect()->back();
    }
    public function Deleteall(){
        auth()->user()->notifications()->delete();
        flash()->success('all notifaction deleted in successfuly');
        return redirect()->back();
    }
    public function deleteone($id){
   auth()->user()->notifications()->where('id',$id)->delete();
       flash()->success('notifaction deleted in successfuly');
        return redirect()->back();
    }
}

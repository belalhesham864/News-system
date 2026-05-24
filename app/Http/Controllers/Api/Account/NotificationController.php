<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotifactionResource;
use Dom\Comment;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getcomment(){
        $user=Auth::guard('sanctum')->user();
        $notifactions=$user->notifications;
   
        $unreadnotifacton=$user->unreadNotifications;
      return apiResponse(200,'Notifaction',['AllNotifaction'=>NotifactionResource::collection($notifactions),'unread'=>NotifactionResource::collection($unreadnotifacton)]);
    }
    public function readnotifaction($id){
      $user=Auth::guard('sanctum')->user();
    $notifaction=$user->notifications->where('id',$id)->first();
    if(!$notifaction){
      return apiResponse(404,'Not Notifaction Found');
    }
    $notifaction->markAsRead();
    return apiResponse(200,'Notifaction readed');
    }
}


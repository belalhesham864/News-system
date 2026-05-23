<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotifactionResource;
use Dom\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getcomment(){
        $user=Auth::guard('sanctum')->user();
        $notifactions=$user->notifications;
   
        $unreadnotifacton=$user->unreadNotifications;
      return apiResponse(200,'Notifaction',['AllNotifaction'=>NotifactionResource::collection($notifactions),'unread'=>NotifactionResource::collection($unreadnotifacton)]);
    }
}


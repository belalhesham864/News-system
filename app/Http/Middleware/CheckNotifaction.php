<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckNotifaction
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->query('notify')){
            if(auth()->guard('sanctum')->check()){
                
                $notifaction=Auth::guard('sanctum')->user()->unreadNotifications->where('id',$request->query('notify'))->first();
            }else{

                $notifaction=Auth::guard('web')->user()->unreadNotifications->where('id',$request->query('notify'))->first();
                }

           if($notifaction){
            $notifaction->markAsRead();
           }
        }
        if($request->query('notifyadmin')){
           $notifyadmin=auth('admin')->user()->unreadNotifications->where('id',$request->query('notifyadmin'))->first();

           if($notifyadmin){
            $notifyadmin->markAsRead();
           }
        }
        return $next($request);
    }
}

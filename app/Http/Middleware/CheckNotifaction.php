<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
           $notifaction=auth()->user()->unreadNotifications()->where('id',$request->query('notify'))->first();

           if($notifaction){
            $notifaction->markAsRead();
           }
        }
        return $next($request);
    }
}

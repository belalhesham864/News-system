<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use function Flasher\Prime\flash;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('web')->check() && Auth::guard('web')->user()->status==0){
            flash()->error('Your account has been blocked.');
          Auth::logout();
 return redirect()->route('login');
               
        }
        return $next($request);
    }
}

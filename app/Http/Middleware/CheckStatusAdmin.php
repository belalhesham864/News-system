<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckStatusAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->status==0){
            Auth::guard('admin')->logout();
            flash()->error('Your Account Blocked By Manger');
            return redirect()->route('admin.login.show');
        }
        return $next($request);
    }
}

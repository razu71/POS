<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        dd(Auth::user());
        if(Auth::user() && Auth::user()->role==USER_ROLE_ADMIN){
            return $next($request);
        }elseif (Auth::user()->role==USER_ROLE_SUPERADMIN) {
            return redirect()->route('getDashboard');
        }

        return redirect()->route('login');
    }
}

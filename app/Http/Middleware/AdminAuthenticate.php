<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard(null)->check()) {
            $user = Auth::user();

            if($user->hasPermissionTo('admin_panel')){
                return $next($request);
            } else{
                Auth::logout();
                return redirect()->guest('/login');
            }
        } else {
            return redirect()->guest('/login-admin');
        }
    }
}

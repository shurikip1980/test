<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard(null)->check()){
            $user = Auth::user();
            if($user->hasPermissionTo('cabinet_panel')){
                return $next($request);
            } else {
                Auth::logout();
                return redirect('/login-admin');
            }
        } else {
            return redirect('/')->with('success_up', 'Login');
        }

    }
}

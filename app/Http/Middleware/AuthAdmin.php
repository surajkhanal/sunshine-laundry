<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class AuthAdmin
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
        if(Auth::check()) {
            $user = Auth::user();
            if($user->userType->user_type_name == 'Staff' && $user->user_status == 1) {
                return redirect('/dashboard');
            } else if($user->userType->user_type_name == 'Staff' && $user->user_status == 0) {
                Auth::logout();
                return redirect('/');
            }
            return $next($request);
        } else {
            
            return redirect('/');
        }
    }
}

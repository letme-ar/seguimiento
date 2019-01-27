<?php

namespace App\Http\Middleware;

use Closure;

class CheckChangePassword
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
        if(\Auth::check())
        {
            if ($request->user()->password_change == 1)
            {
//                return response(redirect('change-password'));
                $user = $request->user();
                return response(View('auth.change-password',compact('user')));
            }
        }

        return $next($request);
    }
}

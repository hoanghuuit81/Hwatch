<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class customerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = 'cus')
    {
        if (Auth::guard($guard)->check()) {
            return $next($request);         
        }

        return redirect()->route('clien.login')->with('warning','Bạn cần đăng nhập để làm hành động này!');
        

    }
}

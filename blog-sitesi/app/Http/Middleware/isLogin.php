<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;


use Closure;
use Illuminate\Http\Request;

class isLogin
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
        if(Auth::check()){ //Bu middleware admin girişi yapılmışsa tekrar giriş yapılmasını engelleyecek.
            return redirect()->route('admin.dashboard'); //Check metodu bir giriş olup olmadığını kontrol ediyor. Giriş yoksa yönlendiriyoruz. Varsa return edecek.
        }
        return $next($request);
    }
}

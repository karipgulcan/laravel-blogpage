<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;


use Closure;
use Illuminate\Http\Request;

class isAdmin
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
        /*
        if(Auth::check()){ //Bu middleware admin grişi yapmadan panelin açılmasını engelleyecek.
            return redirect()->route('admin.login'); //Check metodu bir giriş olup olmadığını kontrol ediyor. Giriş yoksa yönlendiriyoruz. Varsa return edecek.
        }
        */
        return $next($request);
    }
}
 

// Bu middleware i kullanabilmek için önce Kernel in içindeki middleware grubuna eklememiz gerekiyor. Aslında route da kullanabilmek için kernel e ekledik
// Daha sonrasında route da tanımlaması yapılması gerekiyor.
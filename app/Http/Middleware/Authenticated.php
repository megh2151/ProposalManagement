<?php

namespace App\Http\Middleware;

use Closure;

class Authenticated
{
    public function handle($request, Closure $next)
    {
        if(auth()->user() && auth()->user()->role_id == 1){
            return $next($request);
        } else if(auth()->user() && auth()->user()->role_id == 2){
            return $next($request);
        }else if(auth()->user() && auth()->user()->role_id == 0){
            return $next($request);
        }

        return redirect('/')->with('error', "You have no proper authentication to access the area!");
    }
}
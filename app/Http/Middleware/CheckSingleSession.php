<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Session;
use Closure;

class CheckSingleSession {
    
    public function handle($request, Closure $next) {
        
        if (auth()->user()) {
            if( Session::getId() != auth()->user()->session_id ){
                auth()->logout();
            }
        }

        return $next($request);
    }
}


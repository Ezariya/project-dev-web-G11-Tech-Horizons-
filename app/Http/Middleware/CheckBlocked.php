<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckBlocked
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->blocked) {
            Auth::logout();
            return redirect()->route('login')->withErrors('Votre compte est bloqué.');
        }

        return $next($request);
    }

}

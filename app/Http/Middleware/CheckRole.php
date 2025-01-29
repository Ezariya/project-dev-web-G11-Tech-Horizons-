<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Vérifier que l'utilisateur est connecté et a le rôle approprié
        if (Auth::check() && Auth::user()->role && Auth::user()->role->name === $role) {
            return $next($request);
        }

        // Sinon, rediriger ou afficher une erreur
        return redirect('/')->withErrors('Accès refusé !');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
//use App\User;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(Auth::user()->role == 'injecteur'){
                    return redirect('/ajouter-client');
               }elseif (Auth::user()->role == 'caissiere') {
                    return redirect('/dashboard');
               }elseif (Auth::user()->role == 'admin') {
                   return redirect('/adminDashboard');
               }
            return redirect('donneur');
           
        }

        return $next($request);
    }
}

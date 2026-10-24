<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PersonnelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
public function handle($request, Closure $next)
{
    $user = Auth::user();

    // if ($user && optional($user->role)->name === 'personnel') {
    //     return $next($request);
    // }

    if ($user && $user->role->name === 'personnel') {
        return $next($request);
    }

    abort(403, 'Unauthorized');
}
}

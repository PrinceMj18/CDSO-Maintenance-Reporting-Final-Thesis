<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
public function handle($request, Closure $next)
{
    $user = Auth::user();

    if ($user && $user->role->name === 'user') {
        return $next($request);
    }

    abort(403);
}
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
public function handle($request, Closure $next)
{
    $user = Auth::user();

    if ($user && $user->role->name === 'admin') {
        return $next($request);
    }

    abort(403);
}
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->inRole('admin')) {
            return $next($request);
        }

        abort(403); // Доступ запрещён
    }
}

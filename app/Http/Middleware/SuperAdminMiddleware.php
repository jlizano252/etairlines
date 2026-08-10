<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (
            !auth()->check() ||
            auth()->user()->email !== 'jlizano@iacsa.cr'
        ) {
            abort(403);
        }

        return $next($request);
    }
}

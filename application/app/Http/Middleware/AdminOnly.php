<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminOnly
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (!isAdmin()) {
            abort(401, trans('Admin only'));
        }

        return $next($request);
    }
}

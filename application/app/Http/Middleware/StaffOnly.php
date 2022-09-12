<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StaffOnly
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (!isStaff()) {
            abort(401);
        }

        return $next($request);
    }
}

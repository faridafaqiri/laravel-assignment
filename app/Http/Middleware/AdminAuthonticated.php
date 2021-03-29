<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuthonticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->isSuperUser() || $request->user()->isStaffUser()) {
            return $next($request);
        } else {
            return redirect('/');
        }

    }
}

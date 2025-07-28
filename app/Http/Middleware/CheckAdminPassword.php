<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminPassword
{
    public function handle(Request $request, Closure $next)
{
    if (!$request->session()->get('is_admin')){
        abort(403);
    }

    return $next($request);
}
}

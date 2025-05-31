<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsTailor
{
    public function handle($request, Closure $next)
{
    if (!auth()->check()) {
        return response('Not authenticated', 401);
    }

    if (auth()->user()->role !== 'tailor') {
        return response('Forbidden', 403);
    }

    return $next($request);
}
}


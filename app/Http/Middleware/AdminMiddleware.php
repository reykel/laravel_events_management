<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public const ROLES = [
        'Admin'
    ];
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (!in_array($request->user()->role->name, self::ROLES)) {
            abort(401, 'Its not authorized');
        }
        return $next($request);
    }
}

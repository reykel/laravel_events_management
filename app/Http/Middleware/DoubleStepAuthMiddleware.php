<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class DoubleStepAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $url = $request->url();
        $ref = null;
        if(str_contains($url, 'driver-accept') || str_contains($url, 'driver-reject')){
          $ref = $url;
        }
        $user = Auth::User();
        if (!$user) {
            Cookie::queue('ref', $ref, 10);
            return redirect(route('login'));
        }
        if ((!$user->confirmed)) {
            return redirect(route('verify_code'));
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HotlinkProtectionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $referer = $request->headers->get('referer');
        $allowedDomain = 'http://localhost/'; // Replace with your domain

        if (empty($referer) || parse_url($referer, PHP_URL_HOST) !== $allowedDomain) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}

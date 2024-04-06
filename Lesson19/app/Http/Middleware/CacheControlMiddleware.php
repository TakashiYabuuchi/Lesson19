<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CacheControlMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
 * @param \Closure(\Illuminate\Http\Request):(\Symfony\Component\HttpFoundation\Response)  $next
 * @return Response
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->header('Cache-Control', 'no-store');
        $response->header('Pragma', 'no-cache');

        return $response;
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\Redirect;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class RedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cacheKey = 'redirects';

        $redirects = Cache::remember($cacheKey, now()->addYear(), function () {
            return Redirect::all()->pluck('target', 'source');
        }, now()->addYear());

        $path = $request->getPathInfo();

        if (isset($redirects[$path])) {
            return redirect($redirects[$path], 301);
        }

        return $next($request);
    }
}

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
        $path = $request->getPathInfo();

        $redirect = Cache::rememberForever("redirects.$path", function () use ($path) {
            return Redirect::where('source', $path)->value('target');
        });

        if ($redirect) {
            return redirect($redirect, 301);
        }

        return $next($request);
    }
}

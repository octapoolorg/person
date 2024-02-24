<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class EnsureUuidExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->hasCookie('uuid')) {
            $uuid = (string) Str::uuid();
            $expires = 60 * 24 * 30 * 9; // 9 months
            Cookie::queue('uuid', $uuid, $expires);
        }

        return $next($request);
    }
}

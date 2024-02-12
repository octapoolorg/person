<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class EnsureUuidExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->hasCookie('uuid')) {
            $uuid = Str::uuid();
            $expires = 60 * 24 * 30 * 9; // 9 months
            Cookie::queue('uuid', $uuid, $expires);
        }

        return $next($request);
    }
}

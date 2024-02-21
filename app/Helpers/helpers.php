<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use App\Jobs\UpdateCacheJob;

if (! function_exists('normalize_name')) {
    function normalize_name($name): array|string|null
    {
        $normalized = iconv('UTF-8', 'ASCII//TRANSLIT', $name);

        return preg_replace('/[^A-Za-z0-9 ]/', '', $normalized);
    }
}

if (! function_exists('sanitize_name')) {
    function sanitize_name(string $name)
    {
        return strtolower(preg_replace('/[^A-Za-z0-9]/', '', $name));
    }
}

if (! function_exists('random_word')) {
    function random_word(array $words): string
    {
        return $words[array_rand($words)];
    }
}

if (!function_exists('cache_remember')) {
    function cache_remember($key, $callback, $ttl = null, $default = null)
    {
        $ttl = $ttl ?? now()->addDay();

        // Check if cache exists
        if (Cache::has($key)) {
            // Return the cached value if it exists
            return Cache::get($key);
        } else {
            // Dispatch a job to update the cache in the background
            UpdateCacheJob::dispatch($key, $callback, $ttl);

            // Return stale content if available, otherwise return default value
            return Cache::get($key, $default);
        }
    }
}

if (! function_exists('paginate')) {
    function paginate($items, $perPage = 15)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 30;
        $currentPageSearchResults = $items->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $items = new LengthAwarePaginator($currentPageSearchResults, count($items), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);

        return $items;
    }
}

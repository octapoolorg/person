<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

if (! function_exists('normalize_name')) {
    function normalize_name($name): array|string|null
    {
        $normalized = str($name)->ascii($name);

        return preg_replace('/[^A-Za-z0-9 ]/', '', $normalized);
    }
}

if (! function_exists('fix_name')) {
    function fix_name($name): string
    {
        $name = normalize_name($name);
        $length = strlen($name);

        // Check if the length of the name is greater than 8
        if ($length > 8) {
            $parts = explode(' ', $name);
            $firstPart = $parts[0];
            $firstPartLength = strlen($firstPart);

            // Check if the length of the first part is at least 3 and at most 8
            if ($firstPartLength >= 3 && $firstPartLength <= 8) {
                // Return the first part of the name
                return $firstPart;
            }

            // If the first part is less than 3 characters or more than 8, return the first 8 characters of the name
            return substr($name, 0, 8);
        }

        // If the length of the name is not greater than 8, return the name as is
        return $name;
    }
}

// slug to name, without any special characters , numbers. only alphabets,replace - with space, first part of name
if (! function_exists('slug_name')) {
    function slug_name(string $slug): string
    {
        $name = normalize_name($slug);

        return str_replace('-', ' ', $name);
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

if (! function_exists('cache_remember')) {
    function cache_remember($key, $callback, $ttl = null)
    {
        $ttl = $ttl ?? now()->addDay();

        return Cache::remember($key, $ttl, $callback);
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

<?php

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

if (! function_exists('cache_remember')) {
    function cache_remember($key, $callback, $ttl = null)
    {
        $ttl = $ttl ?? now()->addYear();

        return \Illuminate\Support\Facades\Cache::remember($key, $ttl, $callback);
    }
}

<?php

use Illuminate\Pagination\LengthAwarePaginator;

if (! function_exists('normalize_name')) {
    function normalize_name($name): array|string|null
    {
        $normalized = str($name)->ascii($name);

        return preg_replace('/[^A-Za-z0-9 ]/', '', $normalized);
    }
}

if (! function_exists('get_first_part_of_name')) {
    function get_first_part_of_name(string $name): string
    {
        $name = normalize_name($name);
        $words = explode(' ', $name);

        // if first part is only one character, then return first two words
        // else return first word
        if (strlen($words[0]) == 1) {
            return implode(' ', array_slice($words, 0, 2));
        } else {
            $firstWord = $words[0];
        }

        // if first word is more than 8 characters, and have more than 2 words, then return first character of each word
        // else return first 8 characters
        if (strlen($firstWord) > 7 && count($words) > 2) {
            return implode('', array_map(function($word) {
                return $word[0];
            }, $words));
        } else {
            return $firstWord;
        }
    }
}

// slug to name, without any special characters , numbers. only alphabets,replace - with space, first part of name
if (! function_exists('slug_name')) {
    function slug_name(string $slug): string
    {
        return get_first_part_of_name(str_replace('-', ' ', $slug));
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

        return \Illuminate\Support\Facades\Cache::remember($key, $ttl, $callback);
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

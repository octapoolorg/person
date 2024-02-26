<?php

namespace App\Services\Name;

use App\Models\Name;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class SearchService
{
    public function search(Request $request): Paginator
    {
        $this->validateSearchRequest($request);

        $cacheKey = $this->generateSearchCacheKey($request);

        return cache_remember($cacheKey, function () use ($request) {
            return $this->executeSearchQuery($request);
        });
    }

    private function validateSearchRequest(Request $request)
    {
        $request->validate([
            'q' => 'nullable|string',
            'origin' => 'nullable|string',
        ]);
    }

    private function generateSearchCacheKey(Request $request): string
    {
        $params = $request
            ->collect()
            ->sortKeys()
            ->map(function ($value, $key) {
                return $key.':'.$value;
            })->implode(':');

        return 'search:'.$params;
    }

    private function executeSearchQuery(Request $request) : Paginator
    {
        $query = Name::query();

        $this->applyRequestFilters($query, $request);

        $query->orderBy('is_popular', 'desc')->orderBy('name', 'asc');

        $names = $query->simplePaginate(45);
        $names->appends($request->query());

        return $names;
    }

    private function applyRequestFilters($query, Request $request)
    {
        $shouldApplyPopular = true;

        if ($request->filled('q')) {
            if (strlen($request->input('q')) > 3) {
                $query->withoutGlobalScopes();
                $shouldApplyPopular = false;
            }
            $query->where('names.name', 'like', $request->input('q').'%');
        }

        // Apply 'origin' filter if provided
        $request->whenFilled('origin', function ($origin) use ($query) {
            $query->whereHas('origins', function ($q) use ($origin) {
                $q->where('slug', $origin);
            });
        });

        // Apply 'gender' filter
        $request->whenFilled('gender', function ($gender) use ($query) {
            $query->where('gender', $gender);
        });

        // Finally, apply 'popular' filter if needed
        if ($shouldApplyPopular) {
            $query->popular();
        }
    }
}
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

        $query->orderBy('popularity', 'desc')->orderBy('name', 'asc');

        $names = $query->simplePaginate(45);
        $names->appends($request->query());

        return $names;
    }

    private function applyRequestFilters($query, Request $request)
    {
        $this->applySearchFilterIfFilled($query, $request);

        $this->applyFilterIfFilled($query, $request, 'origin', 'origins', 'slug');
        $this->applyFilterIfFilled($query, $request, 'gender', 'gender');
    }

    private function applySearchFilterIfFilled($query, Request $request)
    {
        $request->whenFilled('q', function ($value) use ($query) {

            $this->applySearchFilter($query, $value);
        });
    }

    private function applySearchFilter($query, $value)
    {
        $query->where('names.name', 'like', $value.'%');
        if (strlen($value) > 2) {
            $query->withoutGlobalScopes();
        }else{
            $query->popular();
        }
    }

    private function applyFilterIfFilled($query, Request $request, $requestKey, $queryKey, $subQueryKey = null)
    {
        $request->whenFilled($requestKey, function ($value) use ($query, $queryKey, $subQueryKey) {
            if ($subQueryKey) {
                $query->whereHas($queryKey, function ($q) use ($subQueryKey, $value) {
                    $q->where($subQueryKey, $value);
                });
            } else {
                $query->where($queryKey, $value);
            }
        });
    }
}
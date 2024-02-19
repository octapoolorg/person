<?php

namespace App\Services\Name;

use App\Models\Favorite;
use App\Models\Name;
use App\Services\Numerology\NumerologyFactory;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class NameService
{
    protected UtilityService $utilityService;

    public function __construct(UtilityService $utilityService)
    {
        $this->utilityService = $utilityService;
    }

    public function getName(string $nameSlug): array
    {
        $name = cache_remember("name:$nameSlug", function () use ($nameSlug) {
            $name = Name::query()
                ->withoutGlobalScopes()
                ->with(['comments'])
                ->where('slug', $nameSlug)
                ->firstOrFail();

            $sortedMeanings = collect(explode(',', $name->meaning))
                ->sort(function ($a, $b) {
                    return Str::length($b) <=> Str::length($a);
                });

            // Adjust to ensure mainMeaning contains 3 elements if possible
            if ($sortedMeanings->count() > 3) {
                $mainMeanings = $sortedMeanings->splice(0, 3);
                $name->mainMeaning = $mainMeanings->implode(', ');
            } else {
                $name->mainMeaning = $sortedMeanings->implode(', ');
                $name->meanings = collect();
                return $name; // Early return if not enough meanings for separation
            }

            // Adjust to distribute meanings evenly across 5 elements
            $chunkSize = max(3, ceil($sortedMeanings->count() / 5));
            $remainingMeanings = $sortedMeanings->chunk($chunkSize);
            $name->meanings = $remainingMeanings->map(function ($chunk) {
                return $chunk->implode(', ');
            });

            // Limit the number of meanings to 5
            $name->meanings = $name->meanings->slice(0, 5);

            return $name;
        });

        return [
            'name' => $name,
            'numerology' => NumerologyFactory::create('pythagorean')->getNumerologyData($name->name),
            'abbreviations' => $this->utilityService->getAbbreviations($name->name),
            'fancyTexts' => $this->utilityService->getFancyTexts($name->name),
            'wallpaperUrls' => $this->utilityService->wallpaperUrls($name->slug),
            'signatureUrls' => $this->utilityService->signatureUrls($name->slug),
            'userNames' => $this->utilityService->getUsernames($name->name),
        ];
    }

    public function getFavorites(): LengthAwarePaginator
    {
        $uuid = request()->cookie('uuid');

        $nameSlugs = cache_remember("favorites:$uuid", function () use ($uuid) {
            return Favorite::where('uuid', $uuid)->pluck('slug');
        });

        $names = Name::query()->withoutGlobalScopes()->whereIn('slug', $nameSlugs)->get();

        return paginate($names, 30);
    }

    public function search(Request $request): LengthAwarePaginator
    {
        $request->validate([
            'q' => 'nullable|string',
            'origin' => 'nullable|string',
        ]);

        $params = $request
            ->collect()
            ->sortKeys()
            ->map(function ($value, $key) {
                return $key . ':' . $value;
            })->implode(':');

        $cacheKey = 'search:' . $params;

        return cache_remember($cacheKey, function () use ($request) {
            $query = Name::query()
                ->with(['gender', 'origins'])
                ->withoutGlobalScopes();

            $request->whenFilled('q', function ($searchTerm) use ($query) {
                $query->where('names.name', 'like', $searchTerm . '%');
            });

            $request->whenFilled('origin', function ($origin) use ($query) {
                $query->whereHas('origins', function ($q) use ($origin) {
                    $q->validGender()->popular()->select('slug')->where('slug', $origin);
                });
            });

            $request->whenFilled('gender', function ($gender) use ($query) {
                $query->validGender()->popular()
                    ->join('genders', 'names.gender_id', '=', 'genders.id')
                    ->where('genders.slug', $gender)
                    ->select('names.*');
            });

            $names = $query->take(200)->get();

            $names = $names->sortBy('is_popular');
            $names = $names->sortBy('name');

            $names = paginate($names, 50);

            $names->appends($request->query());

            return $names;
        });
    }
}

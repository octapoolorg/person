<?php

namespace App\Services\Name;

use App\Models\Abbreviation;
use App\Models\Favorite;
use App\Models\Guest;
use App\Models\Name;
use Hashids\Hashids;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DetailService
{
    private ToolService $toolService;

    public function __construct(ToolService $toolService)
    {
        $this->toolService = $toolService;
    }

    public function getName(string $nameSlug): array
    {
        $name = $this->fetchNameData($nameSlug);

        return $this->prepareResponseData($name);
    }

    private function fetchNameData(string $nameSlug)
    {
        return cache_remember("name:$nameSlug", function () use ($nameSlug) {
            return $this->queryNameData($nameSlug);
        });
    }

    private function queryNameData(string $nameSlug)
    {
        $name = Name::query()
            ->withoutGlobalScopes()
            ->with([
                'origins.meanings' => function ($query) use ($nameSlug) {
                    $this->filterMeaningsBasedOnSlug($query, $nameSlug);
                },
                'comments', 'nicknames', 'similarNames', 'siblingNames'
            ])
            ->where('slug', $nameSlug)
            ->firstOrFail();

        $this->processMeanings($name);

        return $name;
    }

    private function filterMeaningsBasedOnSlug($query, string $nameSlug)
    {
        $query->whereExists(function ($subQuery) use ($nameSlug) {
            $subQuery->select(DB::raw(1))
                ->from('names')
                ->whereColumn('names.id', 'meanings.name_id')
                ->where('names.slug', $nameSlug);
        });
    }

    private function processMeanings($name)
    {
        $sortedMeanings = collect(explode(',', $name->meaning))
            ->sort(function ($a, $b) {
                return Str::length($b) <=> Str::length($a);
            });

        if ($sortedMeanings->count() > 3) {
            $mainMeanings = $sortedMeanings->splice(0, 3);
            $name->mainMeaning = $mainMeanings->implode(', ');
        } else {
            $name->mainMeaning = $sortedMeanings->implode(', ');
            $name->meanings = collect();
            return;
        }

        $chunkSize = max(3, ceil($sortedMeanings->count() / 5));
        $remainingMeanings = $sortedMeanings->chunk($chunkSize);
        $name->meanings = $remainingMeanings->map(function ($chunk) {
            return $chunk->implode(', ');
        });
    }

    private function prepareResponseData($name): array
    {
        return [
            'name' => $name,
            'wallpapers' => $this->toolService->getWallpapers($name->slug),
            'signatures' => $this->toolService->getSignatures($name->slug),
            'fancyTexts' => $this->toolService->getFancyTexts($name->name),
            'userNames'  => $this->toolService->getUsernames($name->name),
            'numerology' => $this->toolService->getNumerology($name->name),
            'abbreviations' => $this->getAbbreviations($name->name),
            'quotes' => $this->getQuotes($name->name),
            'statuses' => $this->getStatuses($name->name),
        ];
    }

    public function getQuotes(string $name): Collection
    {
        $quotes = collect(__('quotes', ['name' => $name]));

        return $quotes->random(3);
    }

    public function getStatuses(string $name): Collection
    {
        $statuses = collect(__('statuses', ['name' => $name]));

        return $statuses->random(3);
    }

    public function getAbbreviations(string $name): Collection
    {
        $name = normalize_name($name);
        $alphabets = collect(str_split($name))->filter(function ($alphabet) {
            return $alphabet !== ' ';
        })->toUpper()->toArray();

        // Getting abbreviations for the alphabets
        $abbreviationsCollection = cache_remember("abbreviations", function () use ($alphabets) {
            return Abbreviation::get()->groupBy('alphabet');
        });

        $abbreviations = [];
        foreach ($alphabets as $alphabet) {
            $alphabetKey = strtoupper($alphabet);

            // Check if there are multiple abbreviations for the alphabet and pick one randomly
            if (isset($abbreviationsCollection[$alphabetKey]) && $abbreviationsCollection[$alphabetKey]->count() > 0) {
                $randomAbbreviation = $abbreviationsCollection[$alphabetKey]->random();
                $abbreviations[] = [$alphabet => $randomAbbreviation->name ?? null];
            } else {
                $abbreviations[] = [$alphabet => null];
            }
        }

        return collect($abbreviations);
    }

    public function getFavorites(?string $favorite = null): array
    {
        $guest =
            $favorite === null ?
            Guest::query()->where('uuid', request()->cookie('uuid'))->firstOrFail() :
            Guest::query()->where('hash', $favorite)->firstOrFail();

        $nameSlugs = cache_remember("favorites:$guest->id", function () use ($guest) {
            return Favorite::where('guest_id', $guest->id)->pluck('slug');
        });

        $names = Name::query()
                ->withoutGlobalScopes()
                ->whereIn('slug', $nameSlugs)
                ->simplePaginate(50);

        return [
            'names' => $names,
            'guest' => $guest,
        ];
    }
}
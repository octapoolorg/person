<?php

namespace App\Services\Name;

use App\Models\Abbreviation;
use App\Models\Favorite;
use App\Models\Guest;
use App\Models\Name;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DetailService
{
    private ImageService $imageService;
    private ToolService $toolService;

    public function __construct(ImageService $imageService, ToolService $toolService)
    {
        $this->imageService = $imageService;
        $this->toolService = $toolService;
    }

    public function getName(string $nameSlug): object
    {
        $name = $this->fetchNameData($nameSlug);

        if (!$name) {
            abort(404);
        }

        return $this->prepareResponseData($name);
    }

    public function fetchNameData(string $nameSlug)
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
            ->first();

        if (!$name) {
            return null;
        }

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

    private function prepareResponseData($name) : object
    {
        $name->wallpapers = $this->imageService->getWallpapers($name->slug);
        $name->signatures = $this->imageService->getSignatures($name->slug);
        $name->fancyTexts = $this->toolService->getFancyTexts($name->name);
        $name->userNames  = $this->toolService->getUsernames($name->name);
        $name->numerology = $this->toolService->getNumerology($name->name);
        $name->abbreviations = $this->getAbbreviations($name->name);
        $name->quotes = $this->getQuotes($name->name);
        $name->statuses = $this->getStatuses($name->name);
        return $name;
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
        $alphabets = $this->extractAlphabets($name);
        $abbreviationsCollection = $this->fetchAbbreviationsCollection();

        return $this->buildAbbreviations($alphabets, $abbreviationsCollection);
    }

    private function extractAlphabets(string $name): array
    {
        return collect(str_split($name))
            ->filter(function ($alphabet) {
                return $alphabet !== ' ';
            })
            ->map(function ($alphabet) {
                return strtoupper($alphabet);
            })
            ->toArray();
    }

    private function fetchAbbreviationsCollection(): Collection
    {
        return cache_remember("abbreviations", function () {
            return Abbreviation::get()->groupBy('alphabet');
        });
    }

    private function buildAbbreviations(array $alphabets, Collection $abbreviationsCollection): Collection
    {
        $abbreviations = [];

        foreach ($alphabets as $alphabet) {
            $alphabetKey = strtoupper($alphabet);
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
        if ($favorite === null) {
            $guest = Guest::query()->where('uuid', request()->cookie('uuid'))->first();
        } else {
            $guest = Guest::query()->where('hash', $favorite)->first();
        }

        $names = $guest ? $this->getFavoriteNames($guest) : collect();

        return [
            'names' => $names,
            'guest' => $guest,
        ];
    }

    private function getFavoriteNames($guest): Paginator
    {
        $nameSlugs = Favorite::where('guest_id', $guest->id)->pluck('slug');

        $names = Name::query()
            ->withoutGlobalScopes()
            ->whereIn('slug', $nameSlugs)
            ->simplePaginate(45);

        return $names;
    }
}
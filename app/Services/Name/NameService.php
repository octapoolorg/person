<?php

namespace App\Services\Name;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class NameService
{
    private DetailService $detailService;

    private SearchService $searchService;

    public function __construct(DetailService $detailService, SearchService $searchService)
    {
        $this->detailService = $detailService;
        $this->searchService = $searchService;
    }

    public function getName(string $nameSlug): array
    {
        return $this->detailService->getName($nameSlug);
    }

    public function getUserNames(string $nameSlug): Collection
    {
        return $this->detailService->getUserNames($nameSlug);
    }

    public function getQuotes(string $nameSlug): Collection
    {
        return $this->detailService->getQuotes($nameSlug);
    }

    public function getStatuses(string $nameSlug): Collection
    {
        return $this->detailService->getStatuses($nameSlug);
    }

    public function getAbbreviations (string $nameSlug): Collection
    {
        return $this->detailService->getAbbreviations($nameSlug);
    }

    public function getFancyTexts (string $nameSlug,bool $random): Collection
    {
        return $this->detailService->getFancyTexts($nameSlug, $random);
    }

    public function wallpaperUrls (string $nameSlug): Collection
    {
        return $this->detailService->wallpaperUrls($nameSlug);
    }

    public function signatureUrls (string $nameSlug): Collection
    {
        return $this->detailService->signatureUrls($nameSlug);
    }

    public function wallpaper (string $nameSlug, string $style): Response
    {
        return $this->detailService->wallpaper($nameSlug, $style);
    }

    public function signature (string $nameSlug, string $style): Response
    {
        return $this->detailService->signature($nameSlug, $style);
    }

    public function getFavorites(?string $favorite = null): LengthAwarePaginator
    {
        return $this->detailService->getFavorites($favorite);
    }

    public function search(Request $request): LengthAwarePaginator
    {
        return $this->searchService->search($request);
    }
}

<?php

namespace App\Services\Name;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class NameService
{
    private DetailService $detailService;

    private SearchService $searchService;

    private ToolService $toolService;

    public function __construct(DetailService $detailService, SearchService $searchService, ToolService $toolService)
    {
        $this->detailService = $detailService;
        $this->searchService = $searchService;
        $this->toolService   = $toolService;
    }

    public function getName (string $nameSlug): array
    {
        return $this->detailService->getName($nameSlug);
    }

    public function getUserNames (string $nameSlug): Collection
    {
        return $this->toolService->getUserNames($nameSlug);
    }

    public function getQuotes (string $nameSlug): Collection
    {
        return $this->detailService->getQuotes($nameSlug);
    }

    public function getStatuses (string $nameSlug): Collection
    {
        return $this->detailService->getStatuses($nameSlug);
    }

    public function getAbbreviations (string $nameSlug): Collection
    {
        return $this->detailService->getAbbreviations($nameSlug);
    }

    public function getFancyTexts (string $nameSlug,bool $random): Collection
    {
        return $this->toolService->getFancyTexts($nameSlug, $random);
    }

    public function getWallpapers (string $nameSlug): Collection
    {
        return $this->toolService->getWallpapers($nameSlug);
    }

    public function getSignatures (string $nameSlug): Collection
    {
        return $this->toolService->getSignatures($nameSlug);
    }

    public function wallpaper (string $nameSlug, string $style): Response
    {
        return $this->toolService->wallpaper($nameSlug, $style);
    }

    public function signature (string $nameSlug, string $style): Response
    {
        return $this->toolService->signature($nameSlug, $style);
    }

    public function getFavorites (?string $favorite = null): array
    {
        return $this->detailService->getFavorites($favorite);
    }

    public function search (Request $request): Paginator
    {
        return $this->searchService->search($request);
    }
}

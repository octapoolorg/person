<?php

namespace App\Http\Controllers\Name;

use App\Http\Controllers\Controller;
use App\Services\Name\NameService;
use App\Services\Name\UtilityService;
use App\Services\SeoService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NameController extends Controller
{
    private NameService $nameService;
    private UtilityService $utilityService;
    private SeoService $seoService;

    public function __construct(NameService $nameService, UtilityService $utilityService, SeoService $seoService)
    {
        $this->nameService = $nameService;
        $this->utilityService = $utilityService;
        $this->seoService = $seoService;
    }

    public function show(string $nameSlug): View
    {
        $data = $this->nameService->getName($nameSlug);
        $name = $data['name'];

        $this->seoService->getSeoData(
            ['page' => 'name'],
            ['name' => $name->name]
        );

        return view('names.show', compact('name', 'data'));
    }

    /**
     * Search for names based on the query parameter 'q'.
     */
    public function search(Request $request): View
    {
        $names = $this->nameService->search($request);
        $this->seoService->getSeoData(
            ['page' => 'search'],
            ['q' => $request->input('q', '')]
        );

        return view('names.search', compact('names'));
    }

    public function favorites(): View
    {
        $names = $this->nameService->getFavorites();

        $this->seoService->getSeoData(
            ['page' => 'list'],
            ['page' => 'Favorite']
        );

        return view('names.list', compact('names'));
    }

    public function signatures(string $nameSlug): View
    {
        $images = $this->utilityService->signatureUrls($nameSlug);

        return view('names.images', compact('images'));
    }

    public function wallpapers(string $nameSlug): View
    {
        $images = $this->utilityService->wallpaperUrls($nameSlug);

        return view('names.images', compact('images'));
    }
}

<?php

namespace App\Http\Controllers\Name;

use App\Http\Controllers\Controller;
use App\Services\Name\NameService;
use App\Services\Name\UtilityService;
use App\Services\SeoService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class NameController extends Controller
{
    private NameService $nameService;
    private SeoService $seoService;

    public function __construct(NameService $nameService, SeoService $seoService)
    {
        $this->nameService = $nameService;
        $this->seoService = $seoService;
    }

    public function show(string $nameSlug): View
    {
        $data = $this->nameService->getName($nameSlug);
        $name = $data['name'];

        dd($name->meanings);

        foreach ($name->meanings as $meaning) {
            echo "Meaning: " . $meaning->text . "<br> <br>";
        }

        dd();

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
        $images = $this->nameService->signatureUrls($nameSlug);

        return view('names.images', compact('images'));
    }

    public function wallpapers(string $nameSlug): View
    {
        $images = $this->nameService->wallpaperUrls($nameSlug);

        return view('names.images', compact('images'));
    }

    public function wallpaper(string $style, string $nameSlug): Response
    {
        return $this->nameService->wallpaper($nameSlug, $style);
    }

    public function signature(string $style, string $name): Response
    {
        return $this->nameService->signature($name, $style);
    }
}

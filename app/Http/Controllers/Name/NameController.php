<?php

namespace App\Http\Controllers\Name;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Services\Name\NameService;
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

    public function favorites(?string $favorite = null): View
    {
        $myFavorite = $favorite === null;
        $favorites = $this->nameService->getFavorites($favorite);
        $names = $favorites['names'];
        $guest = $favorites['guest'];

        $this->seoService->getSeoData(
            ['page' => 'list'],
            ['page' => 'Favorite']
        );

        return view('names.favorite', compact('names', 'guest', 'myFavorite'));
    }

    public function signatures(string $nameSlug): View
    {
        $name = $this->nameService->getName($nameSlug)['name'];
        $images = $this->nameService->getSignatures($nameSlug);

        $meta = $this->seoService->getSeoData(
            ['page' => 'signatures'],
            ['name' => $name->name]
        );

        return view('names.images', compact('images', 'meta'));
    }

    public function wallpapers(string $nameSlug): View
    {
        $name = $this->nameService->getName($nameSlug)['name'];
        $images = $this->nameService->getWallpapers($nameSlug);

        $meta = $this->seoService->getSeoData(
            ['page' => 'wallpapers'],
            ['name' => $name->name]
        );

        return view('names.images', compact('images', 'meta'));
    }

    public function wallpaper(string $style, string $nameSlug): Response
    {
        $name = $this->nameService->getName($nameSlug)['name']->name;
        return $this->nameService->wallpaper($name, $style);
    }

    public function signature(string $style, string $name): Response
    {
        $name = $this->nameService->getName($name)['name']->name;
        return $this->nameService->signature($name, $style);
    }
}

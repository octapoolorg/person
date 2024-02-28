<?php

namespace App\Http\Controllers\Name;

use App\Http\Controllers\Controller;
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
        $name = $this->nameService->getName($nameSlug);

        $this->seoService->getSeoData(
            [
                'page' => 'name',
                'image' => $name->cover,
            ],
            ['name' => $name->name]
        );

        return view('names.show', compact('name'));
    }

    /**
     * Search for names based on the query parameter 'q'.
     */
    public function search(Request $request): View
    {
        $names = $this->nameService->search($request);
        $this->seoService->getSeoData(
            ['page' => 'search'],
            [
                'q' => str($request->input('q', ''))->headline(),
                'origin' => str($request->input('origin', ''))->headline(),
                'gender' => str($request->input('gender',''))->headline()
            ]
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
        $name = $this->nameService->fetchNameData($nameSlug);
        $signatures = $this->nameService->getSignatures($nameSlug);

        $meta = $this->seoService->getSeoData(
            ['page' => 'signatures'],
            ['name' => $name->name]
        );

        return view('names.signatures', compact('signatures', 'meta', 'name'));
    }

    public function wallpapers(string $nameSlug): View
    {
        $name = $this->nameService->getName($nameSlug);
        $images = $this->nameService->getWallpapers($nameSlug);

        $meta = $this->seoService->getSeoData(
            ['page' => 'wallpapers'],
            ['name' => $name->name]
        );

        return view('names.images', compact('images', 'meta'));
    }

    public function wallpaper(string $style, string $nameSlug): Response
    {
        $name = $this->nameService->fetchNameData($nameSlug)->name ?? slug_name($nameSlug);
        return $this->nameService->wallpaper($name, $style);
    }

    public function signature(string $style, string $name): Response
    {
        $name = $this->nameService->fetchNameData($name)->name ?? slug_name($name);
        return $this->nameService->signature($name, $style);
    }

    public function cover(string $nameSlug): Response
    {
        $name = $this->nameService->getName($nameSlug);
        return $this->nameService->cover($name);
    }
}

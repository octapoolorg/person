<?php

namespace App\Http\Controllers;

use App\Services\Name\NameService;
use App\Services\SeoService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class NameController extends Controller
{
    private NameService $nameService;
    private SeoService $seoService;

    public function __construct(NameService $nameService,SeoService $seoService)
    {
        $this->nameService = $nameService;
        $this->seoService = $seoService;
    }

    public function index(): View
    {
        $names = $this->nameService->getNames();
        $this->seoService->getSeoData(
            ['page'=>'list'],
            ['page'=>'Popular']
        );
        return view('names.list', compact('names'));
    }

    public function show(string $name): View
    {
        $data = $this->nameService->getNameDetails($name);
        $this->seoService->getSeoData(
            ['page'=>'name','image'=>$data['wallpaperUrl']],
            ['name'=>$data['nameDetails']->name]
        );
        return view('names.show', compact('data'));
    }

    public function gender(string $gender): View
    {
        $gender = $this->nameService->getGender($gender);
        $names = $this->nameService->getNamesByGender($gender->slug);
        $this->seoService->getSeoData(
            ['page'=>'list'],
            ['page'=>$gender->name]
        );
        return view('names.list', compact('names'));
    }

    public function origin(string $origin): View
    {
        $origin = $this->nameService->getOrigin($origin);
        $names = $this->nameService->getNamesByOrigin($origin->slug);
        $this->seoService->getSeoData(
            ['page'=>'list'],
            ['page'=>$origin->name]
        );
        return view('names.list', compact('names'));
    }

    public function category(string $category): View
    {
        $category = $this->nameService->getCategory($category);
        $names = $this->nameService->getNamesByCategory($category->slug);
        $this->seoService->getSeoData(
            ['page'=>'list'],
            ['page'=>$category->name]
        );
        return view('names.list', compact('names'));
    }

    public function starting(string $starting): View
    {
        $starting = strtoupper($starting);
        $names = $this->nameService->getNamesByStarting($starting);
        $this->seoService->getSeoData(
            ['page'=>'list'],
            ['page'=>$starting]
        );
        return view('names.list', compact('names'));
    }

    public function ending(string $ending): View
    {
        $ending = strtoupper($ending);
        $names = $this->nameService->getNamesByEnding($ending);
        $this->seoService->getSeoData(
            ['page'=>'list'],
            ['page'=>$ending]
        );
        return view('names.list', compact('names'));
    }

    public function random(): View
    {
        $names = $this->nameService->getRandomNames();
        $this->seoService->getSeoData(
            ['page'=>'list'],
            ['page'=>'Random']
        );
        return view('names.list', compact('names'));
    }

    /**
     * Search for names based on the query parameter 'q'.
     *
     * @return View
     */
    public function search(Request $request): View
    {
        $q = $request->input('q') ?? '';
        $names = $this->nameService->searchNames($request);
        $this->seoService->getSeoData(
            ['page'=>'search'],
            ['q'=>$q]
        );
        return view('names.search', compact('names'));
    }

    public function favorites(): View
    {
        $names = $this->nameService->getFavoriteNames();
        $this->seoService->getSeoData(
            ['page'=>'list'],
            ['page'=>'Favorite']
        );
        return view('names.favorite', compact('names'));
    }

    public function wallpaper(string $nameSlug): Response
    {
        $size = request()->input('size') ?? 'full';
        return $this->nameService->nameWallpaper($nameSlug,$size);
    }

    public function signature(string $fontKey,string $name,): Response
    {
        return $this->nameService->individualSignature($name, $fontKey);
    }

    public function generateUsernames(): JsonResponse
    {
        $name = request()->input('name');
        $userNames = $this->nameService->getUsernames($name);
        $html = view('components.names.api.usernames', compact('userNames'))->render();
        return response()->json($html);
    }

    public function generateAbbreviations(): JsonResponse
    {
        $name = request()->input('name');
        $abbreviations = $this->nameService->getAbbreviations($name);
        $html = view('components.names.api.abbreviations', compact('abbreviations'))->render();
        return response()->json($html);
    }

    public function generateFancyTexts(): JsonResponse
    {
        $name = request()->input('name');
        $fancyTexts = $this->nameService->getFancyTexts($name);
        $html = view('components.names.api.fancy-texts', compact('fancyTexts'))->render();
        return response()->json($html);
    }
}

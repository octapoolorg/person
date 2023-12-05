<?php

namespace App\Http\Controllers;

use App\Models\Origin;
use App\Services\Name\NameService;
use App\Services\SeoService;
use Illuminate\Contracts\View\View;
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
        $names = $this->nameService->getNamesByGender($gender);
        $this->seoService->getSeoData(
            ['page'=>'list'],
            ['page'=>$gender]
        );
        return view('names.list', compact('names'));
    }

    public function origin(string $origin): View
    {
        $origin = Origin::where('slug',$origin)->firstOrFail();
        $names = $this->nameService->getNamesByOrigin($origin->slug);
        $this->seoService->getSeoData(
            ['page'=>'list'],
            ['page'=>$origin->name]
        );
        return view('names.list', compact('names'));
    }

    public function category(string $category): View
    {
        $names = $this->nameService->getNamesByCategory($category);
        $this->seoService->getSeoData(
            ['page'=>'list'],
            ['page'=>$category]
        );
        return view('names.list', compact('names'));
    }

    public function starting(string $starting): View
    {
        $names = $this->nameService->getNamesByStarting($starting);
        $this->seoService->getSeoData(
            ['page'=>'list'],
            ['page'=>$starting]
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
    public function search(): View
    {
        $q = request()->input('q') ?? '';
        $names = $this->nameService->searchNames($q);
        return view('names.search', compact('names'));
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
        $html = view('partials.names.api._usernames', compact('userNames'))->render();
        return response()->json($html);
    }

    public function generateAcronyms(): JsonResponse
    {
        $name = request()->input('name');
        $acronyms = $this->nameService->getAcronyms($name);
        $html = view('partials.names.api._acronyms', compact('acronyms'))->render();
        return response()->json($html);
    }

    public function generateFancyTexts(): JsonResponse
    {
        $name = request()->input('name');
        $fancyTexts = $this->nameService->getFancyTexts($name);
        $html = view('partials.names.api._fancy-texts', compact('fancyTexts'))->render();
        return response()->json($html);
    }
}

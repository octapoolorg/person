<?php

namespace App\Http\Controllers;

use App\Services\Name\NameService;
use App\Services\Name\UsernameGeneratorService;
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
        $this->seoService->getSeoData('list',['page'=>'Popular']);
        return view('names.list', compact('names'));
    }

    public function show(string $name): View
    {
        $data = $this->nameService->getNameDetails($name);
        $this->seoService->getSeoData('name',['name'=>$data['nameDetails']->name]);
        return view('names.show', compact('data'));
    }

    public function gender(string $gender): View
    {
        $names = $this->nameService->getNamesByGender($gender);
        $this->seoService->getSeoData('list',['page'=>$gender]);
        return view('names.list', compact('names'));
    }

    public function random(): View
    {
        $names = $this->nameService->getRandomNames();
        $this->seoService->getSeoData('list',['page'=>'Random']);
        return view('names.list', compact('names'));
    }

    public function search(): View
    {
        $names = $this->nameService->searchNames(request()->input('q'));
        return view('names.search', compact('names'));
    }

    public function wallpaper(string $nameSlug): Response
    {
        return $this->nameService->nameWallpaper($nameSlug);
    }

    public function signature(string $name, string $fontKey): Response
    {
        return $this->nameService->individualSignature($name, $fontKey);
    }

    public function generateUsernames(): JsonResponse
    {
        $name = request()->input('name');
        $userNames = $this->nameService->getUsernames($name);
        $html = view('partials.names._usernames', compact('userNames'))->render();
        return response()->json($html);
    }

    public function generateAcronyms(): JsonResponse
    {
        $name = request()->input('name');
        $acronyms = $this->nameService->getAcronyms($name);
        $html = view('partials.names._acronyms', compact('acronyms'))->render();
        return response()->json($html);
    }

    public function generateFancyTexts(): JsonResponse
    {
        $name = request()->input('name');
        $fancyTexts = $this->nameService->getFancyTexts($name);
        $html = view('partials.names._fancy-texts', compact('fancyTexts'))->render();
        return response()->json($html);
    }
}

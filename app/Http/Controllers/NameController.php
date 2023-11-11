<?php

namespace App\Http\Controllers;

use App\Models\Name;
use App\Services\NameService;
use App\Services\SeoService;
use Illuminate\Contracts\View\View;
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

    public function wallpaper(string $name): Response
    {
        return $this->nameService->nameWallpaper($name);
    }

    public function signature(string $name, string $fontKey): Response
    {
        return $this->nameService->individualSignature($name, $fontKey);
    }
}

<?php

namespace App\Http\Controllers\Name;

use App\Http\Controllers\Controller;
use App\Services\Name\NameService;
use App\Services\SeoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

    public function index(): View
    {
        $names = $this->nameService->getNames();
        $this->seoService->getSeoData(
            ['page' => 'list'],
            ['page' => 'Popular']
        );

        return view('names.list', compact('names'));
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

    public function gender(string $gender): View
    {
        $gender = $this->nameService->getGender($gender);
        $names = $this->nameService->getNamesByGender($gender->slug);
        $this->seoService->getSeoData(
            ['page' => 'list'],
            ['page' => $gender->name]
        );

        return view('names.list', compact('names'));
    }

    public function origin(string $origin): View
    {
        $origin = $this->nameService->getOrigin($origin);
        $names = $this->nameService->getOriginNames($origin->slug);
        $this->seoService->getSeoData(
            ['page' => 'list'],
            ['page' => $origin->name]
        );

        return view('names.list', compact('names'));
    }

    public function category(string $category): View
    {
        $category = $this->nameService->getCategory($category);
        $names = $this->nameService->getCategoryNames($category->slug);
        $this->seoService->getSeoData(
            ['page' => 'list'],
            ['page' => $category->name]
        );

        return view('names.list', compact('names'));
    }

    public function starting(string $starting): View
    {
        $starting = strtoupper($starting);
        $names = $this->nameService->getStartingNames($starting);
        $this->seoService->getSeoData(
            ['page' => 'list'],
            ['page' => $starting]
        );

        return view('names.list', compact('names'));
    }

    public function ending(string $ending): View
    {
        $ending = strtoupper($ending);
        $names = $this->nameService->getEndingNames($ending);
        $this->seoService->getSeoData(
            ['page' => 'list'],
            ['page' => $ending]
        );

        return view('names.list', compact('names'));
    }

    public function random(): View
    {
        $names = $this->nameService->getRandomNames();
        $this->seoService->getSeoData(
            ['page' => 'list'],
            ['page' => 'Random']
        );

        return view('names.list', compact('names'));
    }

    /**
     * Search for names based on the query parameter 'q'.
     */
    public function search(Request $request): View
    {
        $names = $this->nameService->searchNames($request);
        $this->seoService->getSeoData(
            ['page' => 'search'],
            ['q' => $request->input('q', '')]
        );

        return view('names.search', compact('names'));
    }

    public function favorites(): View
    {
        $names = $this->nameService->getFavoriteNames();

        $this->seoService->getSeoData(
            ['page' => 'list'],
            ['page' => 'Favorite']
        );

        return view('names.list', compact('names'));
    }

}

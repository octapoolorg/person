<?php

namespace App\Http\Controllers;

use App\Models\Name;
use App\Services\NameService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class NameController extends Controller
{
    private NameService $nameService;

    public function __construct(NameService $nameService)
    {
        $this->nameService = $nameService;
    }

    public function index(): View
    {
        $names = $this->nameService->getCachedNames();
        return view('names.list', compact('names'));
    }

    public function view(string $name): View
    {
        $data = $this->nameService->getNameDetails($name);
        return view('names.show', compact('data'));
    }

    public function getRandomNames(): View
    {
        $names = $this->nameService->getRandomNames();
        return view('names.list', compact('names'));
    }

    public function search(): View
    {
        $names = $this->nameService->searchNames(request()->input('q'));
        return view('names.search', compact('names'));
    }

    public function nameWallpaper(string $name): Response
    {
        return $this->nameService->nameWallpaper($name);
    }

    public function individualSignature(string $name, string $fontKey): Response
    {
        return $this->nameService->individualSignature($name, $fontKey);
    }
}

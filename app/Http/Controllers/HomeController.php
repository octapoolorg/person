<?php

namespace App\Http\Controllers;

use App\Models\Name;
use App\Services\SeoService;
use Illuminate\View\View;
use Wink\WinkPost;

class HomeController extends Controller
{
    private SeoService $seoService;

    public function __construct(SeoService $seoService)
    {
        $this->seoService = $seoService;
    }

    public function index(): View
    {
        $popularNames = cache_remember('home:names:popular', function () {
            return Name::query()
                ->withoutGlobalScopes()
                ->inRandomOrder()
                ->popular()
                ->take(8)
                ->get();
        });

        $nameOfTheDay = cache_remember('nameOfTheDay', function () use ($popularNames) {
            if ($popularNames->count() > 0) {
                return $popularNames->random();
            } else {
                return null;
            }
        });

        $latestPosts = cache_remember('home:latestPosts', function () {
            return WinkPost::with('tags')
                ->live()
                ->orderBy('publish_date', 'desc')
                ->take(3)
                ->get();
        });

        $this->seoService->getSeoData(['page' => 'home']);

        $data = [
            'popularNames' => $popularNames,
            'latestPosts' => $latestPosts,
            'nameOfTheDay' => $nameOfTheDay,
        ];

        return view('home.index', compact('data'));
    }
}

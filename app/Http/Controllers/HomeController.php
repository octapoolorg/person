<?php

namespace App\Http\Controllers;

use App\Models\Name;
use App\Services\SeoService;
use Illuminate\Support\Facades\Cache;
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
        $popularNames = Cache::remember('home:popularNames', now()->addDay(),function (){
            return Name::orderBy('created_at', 'desc')
                ->validMeaning()
                ->take(8)
                ->get();
        });

        $nameOfTheDay = Cache::remember('nameOfTheDay', now()->addDay(), function () use ($popularNames) {
            if ($popularNames->count() > 0) {
                return $popularNames->random();
            } else {
                return null;
            }
        });

        $latestPosts = Cache::remember('home:latestPosts', now()->addDay(), function () {
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

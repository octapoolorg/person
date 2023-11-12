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
        $popularNames = Cache::remember('popularNames', now()->addDay(),function (){
            return Name::orderBy('created_at', 'desc')
                ->where('meaning', '!=', '')
                ->take(8)
                ->get();
        });

        $latestPosts = Cache::remember('latestPosts', now()->addDay(), function () {
            return WinkPost::with('tags')
                ->live()
                ->orderBy('publish_date', 'desc')
                ->take(3)
                ->get();
        });

        $this->seoService->getSeoData('home');

        $data = [
            'popularNames' => $popularNames,
            'latestPosts' => $latestPosts,
        ];

        return view('home.index', compact('data'));
    }
}

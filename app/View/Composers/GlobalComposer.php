<?php

namespace App\View\Composers;

use App\Models\Name;
use App\Models\Origin;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class GlobalComposer
{
    /**
     * Create a new profile composer.
     */
    public function __construct(
        protected Name $name,
        protected Origin $origin,
    ) {
        // Dependencies automatically resolved by service container...
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $popularNames = Cache::remember('names:random', now()->addDay(), function () {
            return $this->name->withoutGlobalScopes()
                ->popular()
                ->validGender()
                ->random()
                ->where('popularity', '>', 10)
                ->limit(20)
                ->get();
        });

        $origins = Cache::remember('origins', now()->addDay(), function () {
            //only get the origins that have names - at least 5000
            return $this->origin->withCount(['names' => function ($query) {
                $query
                ->withoutGlobalScopes()
                ->popular();
            }])->having('names_count', '>=', 5000)->orderBy('name')->get();
        });

        $genders = Cache::remember('genders', now()->addDay(), function () {
            return $this->name->distinct()->pluck('gender');
        });

        $haveFavorites = request()->cookie('favorites') ? true : false;

        $view->with('popularNames', $popularNames);
        $view->with('origins', $origins);
        $view->with('genders', $genders);
        $view->with('haveFavorites', $haveFavorites);
    }
}

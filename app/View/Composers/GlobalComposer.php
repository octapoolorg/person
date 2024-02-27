<?php

namespace App\View\Composers;

use App\Models\Name;
use App\Models\Origin;
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
        $popularNames = cache_remember('names:random', function () {
            return $this->name->withoutGlobalScopes()
                ->validGender()
                ->random()
                ->where('popularity', '>=', 10)
                ->limit(20)
                ->get();
        });

        $origins = cache_remember('origins', function () {
            //only get the origins that have names - at least 5000
            return $this->origin->withCount(['names' => function ($query) {
                $query
                ->withoutGlobalScopes()
                ->popular();
            }])->having('names_count', '>=', 5000)->orderBy('name')->get();
        });

        $genders = cache_remember('genders', function () {
            return $this->name->distinct()->pluck('gender');
        });

        $haveFavorites = request()->cookie('favorites') ? true : false;

        $view->with('popularNames', $popularNames);
        $view->with('origins', $origins);
        $view->with('genders', $genders);
        $view->with('haveFavorites', $haveFavorites);
    }
}

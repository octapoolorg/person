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
        $trendingNames = cache_remember('names:random', function () {
            return $this->name->withoutGlobalScopes()
            ->random()->popular()
            ->where('popularity', '!=', '')
            ->limit(20)->get();
        }, now()->addDay());

        $origins = cache_remember('origins', function () {
            //only get the origins that have names - at least 5000
            return $this->origin->withCount(['names' => function ($query) {
                $query->where('is_popular', 1);
            }])->having('names_count', '>=', 5000)->orderBy('name')->get();
        });

        $genders = cache_remember('genders', function () {
            return $this->name->distinct()->pluck('gender');
        });

        $favorite = request()->cookie('favorites') ? true : false;

        $view->with('trendingNames', $trendingNames);
        $view->with('origins', $origins);
        $view->with('genders', $genders);
        $view->with('favorite', $favorite);
    }
}

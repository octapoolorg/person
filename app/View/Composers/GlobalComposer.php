<?php

namespace App\View\Composers;

use App\Models\Gender;
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
        protected Gender $gender,
    ) {
        // Dependencies automatically resolved by service container...
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $trendingNames = cache_remember('names:random', function () {
            return $this->name->withoutGlobalScopes()->random()->popular()->limit(20)->get();
        }, now()->addWeek());

        $origins = cache_remember('origins', function () {
            return $this->origin->orderBy('name')->get();
        });

        $genders = cache_remember('genders', function () {
            return $this->gender->get();
        });

        $favorite = request()->cookie('favorites') ? true : false;

        $view->with('trendingNames', $trendingNames);
        $view->with('origins', $origins);
        $view->with('genders', $genders);
        $view->with('favorite', $favorite);
    }
}

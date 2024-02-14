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
        $namesList = cache_remember('names', function () {
            return $this->name->withoutGlobalScopes()->popular()->limit(20)->get();
        });

        $origins = cache_remember('origins', function () {
            return $this->origin->orderBy('name')->get();
        });

        $genders = cache_remember('genders', function () {
            return $this->gender->get();
        });

        $favorite = request()->cookie('favorites') ? true : false;

        $view->with('namesList', $namesList);
        $view->with('origins', $origins);
        $view->with('genders', $genders);
        $view->with('favorite', $favorite);
    }
}

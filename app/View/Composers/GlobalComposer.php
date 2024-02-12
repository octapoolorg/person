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
        $popularNames = cache_remember('footer:names:popular', function () {
            return $this->name->withoutGlobalScopes()->
                inRandomOrder()->
            popular()->limit(4)->get();
        });

        $origins = cache_remember('origins', function () {
            return $this->origin->get();
        });

        $genders = cache_remember('genders', function () {
            return $this->gender->get();
        });

        $favorite = request()->cookie('favorites') ? true : false;

        $view->with('origins', $origins);
        $view->with('genders', $genders);
        $view->with('popularNames', $popularNames);
        $view->with('favorite', $favorite);
    }
}

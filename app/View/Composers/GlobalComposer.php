<?php

namespace App\View\Composers;

use App\Models\Gender;
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
        protected Gender $gender,
    ) {
        // Dependencies automatically resolved by service container...
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $popularNames = Cache::remember('footer:popularNames', now()->addWeek(), function () {
            return $this->name->validMeaning()->popular()->limit(4)->get();
        });

        $origins = Cache::remember('origins', now()->addWeek(), function () {
            return $this->origin->get();
        });

        $genders = Cache::remember('genders', now()->addWeek(), function () {
            return $this->gender->get();
        });

        $favorite = request()->cookie('favorites') ? true : false;

        $view->with('origins', $origins);
        $view->with('genders', $genders);
        $view->with('popularNames', $popularNames);
        $view->with('favorite', $favorite);
    }
}

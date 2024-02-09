<?php

namespace App\View\Composers;

use App\Models\Origin;
use App\Models\Gender;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class NameComposer
{
    /**
     * Create a new profile composer.
     */
    public function __construct(
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
        $origins = Cache::remember('origins', now()->addWeek(), function () {
            return $this->origin->get();
        });
        $genders = Cache::remember('genders', now()->addWeek(), function () {
            return $this->gender->get();
        });

        $view->with('origins', $origins);
        $view->with('genders', $genders);
    }
}

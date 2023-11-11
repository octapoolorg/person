<?php

namespace App\View\Composers;

use App\Models\Name;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class GlobalComposer
{
    /**
     * Create a new profile composer.
     */
    public function __construct(
        protected Name $name,
    ) {
        // Dependencies automatically resolved by service container...
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $popularNames = Cache::remember('popularNames', now()->addWeek(), function () {
            return $this->name->validMeaning()->popular()->limit(4)->get();
        });
        $view->with('popularNames', $popularNames);
    }
}

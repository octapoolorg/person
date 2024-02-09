<?php

namespace App\Providers;

use App\Models\Name;
use App\View\Composers\GlobalComposer;
use App\View\Composers\NameComposer;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Facades\View::composer('*', GlobalComposer::class);

        Facades\View::composer('*', NameComposer::class);
    }
}

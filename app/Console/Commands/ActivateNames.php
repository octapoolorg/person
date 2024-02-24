<?php

namespace App\Console\Commands;

use App\Models\Name;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Command\Command as CommandAlias;

class ActivateNames extends Command
{
    protected $signature = 'app:activate-names';

    protected $description = 'Activate a certain number of names each day, with the number increasing weekly.';

    protected int $baseNumber = 50;

    protected int $weeklyIncrement = 30;

    public function handle(): int
    {
        try {
            $totalNamesToActivateToday = $this->calculateNamesToActivate();
            $this->info("Activating $totalNamesToActivateToday names...");

            $this->activateNames($totalNamesToActivateToday);

            $this->info("Successfully activated $totalNamesToActivateToday names and submitted URLs for SEO.");

            return CommandAlias::SUCCESS;
        } catch (Exception $e) {
            $this->error('Failed to activate names: '.$e->getMessage());
            Log::error('Failed to activate names: '.$e->getMessage(), ['exception' => $e]);

            return CommandAlias::FAILURE;
        }
    }

    private function calculateNamesToActivate(): int
    {
        $startDate = Carbon::parse('2024-01-15');
        $weeksSinceStart = $startDate->diffInWeeks(Carbon::now());

        return $this->baseNumber + ($weeksSinceStart * $this->weeklyIncrement);
    }

    private function activateNames(int $number): void
    {
        $activatedNames = Name::query()->withoutGlobalScopes()
            ->where('is_active', false)
            ->limit($number)
            ->get(['id', 'slug']);

        // get the ids of the activated names
        $activatedNamesIds = $activatedNames->pluck('id')->toArray();

        //get the slugs of the activated names
        $activatedNamesSlugs = $activatedNames->pluck('slug')->toArray();

        Name::withoutGlobalScopes()->whereIn('id', $activatedNamesIds)->update(['is_active' => true]);

        $this->submit($activatedNamesSlugs);
    }

    private function submit(array $activatedNamesSlugs): void
    {
        $lastActivatedNames = collect($activatedNamesSlugs);

        $urls = $lastActivatedNames->map(function ($nameSlug) {
            return route('names.show', ['name' => $nameSlug]);
        })->toArray();

        $this->submitUrlsToSeo($urls);
    }

    private function submitUrlsToSeo(array $urls): void
    {
        if (app()->environment('production')) {
            $this->call('app:seo:urls', ['urls' => $urls]);
        }
    }
}

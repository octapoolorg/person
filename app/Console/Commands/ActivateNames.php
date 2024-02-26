<?php

namespace App\Console\Commands;

use App\Models\Name;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

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

            return Command::SUCCESS;
        } catch (Exception $e) {
            $this->error('Failed to activate names: '.$e->getMessage());
            Log::error('Failed to activate names: '.$e->getMessage(), ['exception' => $e]);

            return Command::FAILURE;
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
        $activatedNames = $this->fetchNamesToActivate($number);

        $this->updateNamesAsActive($activatedNames->pluck('id')->toArray());

        $this->submit($activatedNames->pluck('slug')->toArray());
    }

    private function fetchNamesToActivate(int $number)
    {
        $query = Name::query()->withoutGlobalScopes()
            ->where('is_active', false)
            ->inRandomOrder();

        $query = $this->applyConditionalScope($query);

        return $query->take($number)->get(['id', 'slug']);
    }

    private function applyConditionalScope($query)
    {
        // randomly activate simple names on a certain day of the week
        if (now()->dayOfWeek === rand(0, 6)) {
            return $query->simple();
        } else {
            return $query->popular();
        }
    }

    private function updateNamesAsActive(array $ids): void
    {
        Name::withoutGlobalScopes()->whereIn('id', $ids)->update(['is_active' => true]);
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
            $this->call('app:request-indexing', ['urls' => $urls]);
        }
    }
}

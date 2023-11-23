<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Exception;
use Symfony\Component\Console\Command\Command as CommandAlias;

class ActivateNames extends Command
{
    protected $signature = 'app:activate-names';
    protected $description = 'Activate a certain number of names each day, with the number increasing weekly.';
    protected int $baseNumber = 50;
    protected int $weeklyIncrement = 50;

    public function handle(): int
    {
        try {
            $totalNamesToActivateToday = $this->calculateNamesToActivate();
            $this->info("Activating $totalNamesToActivateToday names...");

            $activatedNamesIds = $this->activateNames($totalNamesToActivateToday);
            $urls = $this->generateUrls($activatedNamesIds);
            $this->submitUrlsToSeo($urls);

            $this->info("Successfully activated $totalNamesToActivateToday names and submitted URLs for SEO.");
            return CommandAlias::SUCCESS;
        } catch (Exception $e) {
            $this->error('Failed to activate names: ' . $e->getMessage());
            Log::error('Failed to activate names: ' . $e->getMessage(), ['exception' => $e]);
            return CommandAlias::FAILURE;
        }
    }

    private function calculateNamesToActivate(): int
    {
        $startDate = Carbon::parse('2023-11-10');
        $weeksSinceStart = $startDate->diffInWeeks(Carbon::now());
        return $this->baseNumber + ($weeksSinceStart * $this->weeklyIncrement);
    }

    private function activateNames(int $number): array
    {
        $activatedNamesIds = DB::table('names')
            ->where('is_active', false)
            ->inRandomOrder()
            ->limit($number)
            ->pluck('id');
        DB::table('names')->whereIn('id', $activatedNamesIds)->update(['is_active' => true]);
        return $activatedNamesIds->toArray();
    }

    private function generateUrls(array $ids): array
    {
        $lastActivatedNames = DB::table('names')
            ->whereIn('id', $ids)
            ->orderByDesc('updated_at')
            ->limit(50)
            ->get(['slug']);
        return $lastActivatedNames->map(function ($name) {
            return route('names.show', ['name' => $name->slug]);
        })->toArray();
    }

    private function submitUrlsToSeo(array $urls): void
    {
        $this->call('app:seo:sitemap',['urls' => $urls]);
    }
}

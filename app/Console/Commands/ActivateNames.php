<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Exception;
use Symfony\Component\Console\Command\Command as CommandAlias;

/**
 * Command to activate a number of names in the database daily, with the number increasing each week.
 */
class ActivateNames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:activate-names';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Activate a certain number of names each day, with the number increasing weekly.';

    /**
     * The base number of names to activate.
     *
     * @var int
     */
    protected int $baseNumber = 50;

    /**
     * The amount to increment the number of names each week.
     *
     * @var int
     */
    protected int $weeklyIncrement = 50;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        try {
            $startDate = Carbon::parse('2023-11-10');
            $currentDate = Carbon::now();

            // Calculate the number of weeks since the start date
            $weeksSinceStart = $startDate->diffInWeeks($currentDate);

            // Calculate the total number to activate based on the number of weeks
            $totalNamesToActivateToday = $this->baseNumber + ($weeksSinceStart * $this->weeklyIncrement);

            $this->info("Activating {$totalNamesToActivateToday} names...");

            // Activate the names
            $activatedCount = DB::table('names')
                ->where('is_active', false)
                ->inRandomOrder()
                ->limit($totalNamesToActivateToday)
                ->update(['is_active' => true]);

            $this->info("Successfully activated {$activatedCount} names.");

            Log::info("Activated {$activatedCount} names.");

            return CommandAlias::SUCCESS;
        } catch (Exception $e) {
            $this->error('Failed to activate names: ' . $e->getMessage());

            Log::error('Failed to activate names: ' . $e->getMessage(), [
                'exception' => $e,
            ]);

            return CommandAlias::FAILURE;
        }
    }
}

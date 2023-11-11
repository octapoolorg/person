<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the app by importing the database and running migrations';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info("Installing app...");

        try {
            $this->info("Running migrations...");
            $this->call('migrate:fresh', ['--force' => true]);

            $this->info("Running database import...");
            $this->call('app:import-database');

            $this->info("Activating names...");
            $this->call('app:activate-names');

            $this->info("App installation was successful.");

        } catch (Exception $e) {
            $this->error("App installation failed: " . $e->getMessage());
        }
    }
}

<?php

namespace App\Console\Commands\Update;

use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the application to the latest version.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Updating the application...');

        $this->call('app:update:database');

        $this->call('cache:clear');
        $this->call('config:clear');
        $this->call('route:clear');
        $this->call('view:clear');

        $this->call('up');

        $this->info('Application updated successfully.');
    }
}

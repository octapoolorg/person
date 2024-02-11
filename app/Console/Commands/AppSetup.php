<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use ZipArchive;

class AppSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the application for installation.';

    /**
     * Execute the console command.
     *
     * @throws Exception
     */
    public function handle(): void
    {
        $zipPath = base_path('data/imports/imports.zip');

        if (file_exists($zipPath)) {
            $this->extractDatabase();
        } else {
            throw new Exception('ZIP file not found');
        }
    }

    /**
     * Extract the database from the zip file.
     *
     * @throws Exception
     */
    private function extractDatabase(): void
    {
        $zip = new ZipArchive();

        if ($zip->open(base_path('data/imports/imports.zip')) === true) {
            $zip->extractTo(base_path('data/imports'));
            $zip->close();
        } else {
            throw new Exception('Failed to open ZIP file');
        }
    }
}

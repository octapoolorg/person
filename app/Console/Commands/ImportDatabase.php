<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\UnavailableStream;

class ImportDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from CSV files into the database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info("Importing data...");

        try {
            DB::transaction(function () {
                $this->importCsv('names.csv', 'names', true);
                $this->importCsv('genders.csv', 'genders',true);
                $this->importCsv('origins.csv', 'origins',true);
                $this->importCsv('categories.csv', 'categories', true);
                $this->importCsv('category_name.csv', 'category_name');
                $this->importCsv('name_origin.csv', 'name_origin');
                $this->importCsv('name_traits.csv', 'name_traits');
            });

            $this->info("Data import was successful.");

        } catch (\Exception $e) {
            $this->error("Data import failed: " . $e->getMessage());
        }
    }

    /**
     * @throws UnavailableStream
     * @throws Exception
     */
    protected function importCsv($filename, $tableName, $generateSlug = false): void
    {
        $csv = Reader::createFromPath(base_path("imports/database/$filename"));
        $csv->setHeaderOffset(0);

        $records = $csv->getRecords();
        $batchSize = 500;
        $batchData = [];
        $slugCount = [];  // To keep track of duplicate slugs

        foreach ($records as $index => $record) {
            // Generate slug if needed
            if ($generateSlug && isset($record['name'])) {
                $baseSlug = Str::slug($record['name']);
                $slug = $baseSlug;

                // Handle duplicate slugs
                if (isset($slugCount[$baseSlug])) {
                    $slugCount[$baseSlug]++;
                    $slug = $baseSlug . '-' . $slugCount[$baseSlug];
                } else {
                    $slugCount[$baseSlug] = 0;
                }

                $record['slug'] = $slug;
            }

            $batchData[] = $record;

            // Insert records in batch
            if (($index + 1) % $batchSize === 0) {
                DB::table($tableName)->insert($batchData);
                $batchData = [];
            }
        }

        // Insert remaining records if any
        if (count($batchData) > 0) {
            DB::table($tableName)->insert($batchData);
        }
    }
}

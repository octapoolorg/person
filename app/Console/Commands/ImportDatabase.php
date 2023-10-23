<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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
                $this->importCsv('names.csv', 'names');
                $this->importCsv('genders.csv', 'genders');
                $this->importCsv('origins.csv', 'origins');
                $this->importCsv('categories.csv', 'categories');
                $this->importCsv('category_name.csv', 'category_name');
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
    protected function importCsv($filename, $tableName): void
    {
        $csv = Reader::createFromPath(base_path("imports/data/$filename"));
        $csv->setHeaderOffset(0);

        $records = $csv->getRecords();
        $batchSize = 500;
        $batchData = [];

        foreach ($records as $index => $record) {
            $batchData[] = $record;

            // Insert records in batch
            if (($index + 1) % $batchSize === 0) {
                DB::table($tableName)->insert($batchData);
                $batchData = [];
            }
        }

        if (count($batchData) > 0) {
            DB::table($tableName)->insert($batchData);
        }
    }
}

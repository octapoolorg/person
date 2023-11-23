<?php

namespace App\Console\Commands\Update;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\SyntaxError;
use League\Csv\UnavailableStream;

class Database extends Command
{
    protected $signature = 'app:update:database';
    protected $description = 'Update the application database to the latest version.';

    public function handle(): void
    {
        $this->info("Updating database...");

        $this->call('migrate', ['--force' => true]);

        try {
            $this->processCsv('genders.csv', 'genders', true);
            $this->processCsv('names.csv', 'names', true);
            $this->processCsv('origins.csv', 'origins', true);
            $this->processCsv('categories.csv', 'categories', true);
            $this->processCsv('category_name.csv', 'category_name');
            $this->processCsv('name_origin.csv', 'name_origin');
            $this->processCsv('name_traits.csv', 'name_traits');

            $this->info("Database updated successfully.");
        } catch (Exception $e) {
            $this->error("Data upsert failed: " . $e->getMessage());
        }
    }

    /**
     * @throws UnavailableStream
     * @throws SyntaxError
     * @throws \League\Csv\Exception
     */
    protected function processCsv($filename, $tableName, $generateSlug = false): void
    {
        $csv = Reader::createFromPath(base_path("imports/database/$filename"));
        $csv->setHeaderOffset(0);
        $stmt = new Statement();
        $existingSlugs = $generateSlug ? DB::table($tableName)->pluck('slug', 'slug')->toArray() : [];

        do {
            $records = iterator_to_array($stmt->process($csv)->getRecords());
            $batchData = [];

            foreach ($records as $record) {
                if ($generateSlug && isset($record['name'])) {
                    $record['slug'] = $this->generateUniqueSlug($record['name'], $existingSlugs);
                    $existingSlugs[$record['slug']] = true;
                }

                $batchData[] = $record;

                if (count($batchData) >= 500) {
                    $this->upsertBatch($batchData, $tableName);
                    $batchData = [];
                }
            }

            if (count($batchData) > 0) {
                $this->upsertBatch($batchData, $tableName);
            }

        } while (count($records) > 0);
    }

    protected function generateUniqueSlug($name, &$existingSlugs): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        while (isset($existingSlugs[$slug])) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    protected function upsertBatch($batchData, $tableName): void
    {
        $columns = Schema::getColumnListing($tableName);
        $upsertData = array_map(function ($record) use ($columns) {
            return array_intersect_key($record, array_flip($columns));
        }, $batchData);

        $uniqueBy = ['id']; // Replace with the appropriate unique identifier
        DB::table($tableName)->upsert($upsertData, $uniqueBy);
    }
}

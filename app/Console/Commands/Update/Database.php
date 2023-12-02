<?php

namespace App\Console\Commands\Update;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use League\Csv\ByteSequence;
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

            $this->call('cache:clear');

            $this->info("Cache cleared successfully.");

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
        $csv->setOutputBOM(ByteSequence::BOM_UTF8);
        $csv->setHeaderOffset(0);

        $chunkSize = 1;
        $totalRows = count($csv);

        for ($offset = 0; $offset < $totalRows; $offset += $chunkSize) {
            $stmt = (new Statement())
                ->offset($offset)
                ->limit($chunkSize);

            $records = $stmt->process($csv);
            $batchData = [];

            foreach ($records as $record) {
                if ($generateSlug && isset($record['name'])) {
                    $record['slug'] = $this->generateUniqueSlug($record['name'], $tableName);
                }

                $batchData[] = $record;
            }

            if (!empty($batchData)) {
                $this->info("Upserting $tableName: $offset / $totalRows");
                DB::transaction(function () use ($batchData, $tableName) {
                    $this->upsertBatch($batchData, $tableName);
                });
            }
        }
    }

    protected function generateUniqueSlug($name, $tableName): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 2;

        while (DB::table($tableName)->where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    protected function upsertBatch($batchData, $tableName): void
    {
        $columns = Schema::getColumnListing($tableName);
        $updateColumns = array_diff($columns, ['is_active', 'created_at']);
        $upsertData = array_map(function ($record) use ($columns) {
            return array_intersect_key($record, array_flip($columns));
        }, $batchData);

        $uniqueBy = ['name'];

        foreach ($upsertData as $data) {
            try {
                DB::table($tableName)->upsert([$data], $uniqueBy, $updateColumns);
            } catch (QueryException $e) {
                // 1062 is the error code for duplicate entry
                if ($e->errorInfo[1] == 1062) {
                    $this->writeDuplicateToFile($data);
                }
            }
        }
    }

    protected function writeDuplicateToFile($data): void
    {
        $file = fopen(base_path('imports/database/backlog/duplicates.csv'), 'a');
        fputcsv($file, $data);
        fclose($file);
    }
}

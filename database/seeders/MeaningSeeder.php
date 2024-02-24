<?php

namespace Database\Seeders;

use App\Models\Meaning;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class MeaningSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $csv = Reader::createFromPath(base_path('data/imports/meanings.csv'), 'r');
        $csv->setHeaderOffset(0);

        $batchSize = 500;
        $timestamp = now();
        $records = [];
        $counter = 0;

        foreach ($csv->getRecords() as $record) {
            $records[] = [
                'name_id' => $record['name_id'],
                'origin_id' => $record['origin_id'],
                'text' => $record['text'],
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];

            $counter++;

            if ($counter % $batchSize === 0) {
                Meaning::insert($records);
                $records = [];
            }
        }

        if (! empty($records)) {
            Meaning::insert($records);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class NameSimilarSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $csv = Reader::createFromPath(base_path('data/imports/name_similar.csv'), 'r');
        $csv->setHeaderOffset(0);

        $batchSize = 500;
        $timestamp = now();
        $records = [];
        $counter = 0;

        foreach ($csv->getRecords() as $record) {
            $records[] = [
                'name_id' => $record['name_id'],
                'similar_name_id' => $record['similar_name_id'],
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];

            $counter++;

            if ($counter % $batchSize === 0) {
                DB::table('name_similar')->insert($records);
                $records = [];
            }
        }

        if (! empty($records)) {
            DB::table('name_similar')->insert($records);
        }
    }
}

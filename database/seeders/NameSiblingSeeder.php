<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class NameSiblingSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $csv = Reader::createFromPath(base_path('data/imports/name_sibling.csv'), 'r');
        $csv->setHeaderOffset(0);

        $batchSize = 500;
        $timestamp = now();
        $records = [];
        $counter = 0;

        foreach ($csv->getRecords() as $record) {
            $records[] = [
                'name_id' => $record['name_id'],
                'sibling_name_id' => $record['sibling_name_id'],
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];

            $counter++;

            if ($counter % $batchSize === 0) {
                DB::table('name_sibling')->insert($records);
                $records = [];
            }
        }

        if (! empty($records)) {
            DB::table('name_sibling')->insert($records);
        }
    }
}

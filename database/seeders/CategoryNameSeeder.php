<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class CategoryNameSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = Reader::createFromPath(base_path('data/imports/category_name.csv'));
        $csv->setHeaderOffset(0);

        $batchSize = 500;
        $timestamp = now();
        $records = [];
        $counter = 0;

        foreach ($csv->getRecords() as $record) {
            $records[] = [
                'category_id' => $record['category_id'],
                'name_id' => $record['name_id'],
            ];

            $counter++;

            if ($counter % $batchSize === 0) {
                DB::insert($records);
                $records = [];
            }
        }

        if (! empty($records)) {
            DB::insert($records);
        }
    }
}

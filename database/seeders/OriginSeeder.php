<?php

namespace Database\Seeders;

use App\Models\Origin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class OriginSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = Reader::createFromPath(base_path('data/imports/origins.csv'));
        $csv->setHeaderOffset(0);

        $batchSize = 500;
        $timestamp = now();
        $records = [];
        $counter = 0;

        foreach ($csv->getRecords() as $record) {
            $records[] = [
                'id' => $record['id'],
                'name' => $record['name'],
                'slug' => str($record['name'])->slug(),
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];

            $counter++;

            if ($counter % $batchSize === 0) {
                Origin::insert($records);
                $records = [];
            }
        }

        if (! empty($records)) {
            Origin::insert($records);
        }
    }
}

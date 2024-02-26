<?php

namespace Database\Seeders;

use App\Models\Name;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class NameSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = Reader::createFromPath(base_path('data/imports/names.csv'));
        $csv->setHeaderOffset(0);

        $batchSize = 500;
        $timestamp = now();
        $records = [];
        $counter = 0;

        foreach ($csv->getRecords() as $record) {
            $records[] = [
                'id' => $record['id'],
                'name' => $record['name'],
                'slug' => $record['slug'],
                'meaning' => $record['meaning'],
                'gender' => $record['gender'],
                'pronunciation' => $record['pronunciation'],
                'is_popular' => $record['is_popular'],
                'is_active' => $record['is_active'],
                'is_simple' => $record['is_simple'],
                'is_ugc' => $record['is_ugc'],
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];

            $counter++;

            if ($counter % $batchSize === 0) {
                Name::insert($records);
                $records = [];
            }
        }

        if (! empty($records)) {
            Name::insert($records);
        }
    }
}

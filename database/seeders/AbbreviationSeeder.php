<?php

namespace Database\Seeders;

use App\Models\Abbreviation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class AbbreviationSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = Reader::createFromPath(base_path('data/imports/abbreviations.csv'));
        $csv->setHeaderOffset(0);

        $batchSize = 500;
        $timestamp = now();
        $records = [];
        $counter = 0;

        foreach ($csv->getRecords() as $record) {
            $records[] = [
                'alphabet' => $record['alphabet'],
                'name' => $record['name'],
            ];

            $counter++;

            if ($counter % $batchSize === 0) {
                Abbreviation::insert($records);
                $records = [];
            }
        }

        if (!empty($records)) {
            Abbreviation::insert($records);
        }
    }
}

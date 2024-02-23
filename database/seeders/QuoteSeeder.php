<?php

namespace Database\Seeders;

use App\Models\Quote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class QuoteSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $csv = Reader::createFromPath(base_path('data/imports/quotes.csv'), 'r');
        $csv->setHeaderOffset(0);

        $batchSize = 500;
        $timestamp = now();
        $records = [];
        $counter = 0;

        foreach ($csv->getRecords() as $record) {
            $records[] = [
                'id' => $record['id'],
                'text' => $record['text'],
                'name_id' => $record['name_id'],
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];

            $counter++;

            if ($counter % $batchSize === 0) {
                Quote::insert($records);
                $records = [];
            }
        }

        if (!empty($records)) {
            Quote::insert($records);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Nickname;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class NicknameSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $csv = Reader::createFromPath(base_path('data/imports/nicknames.csv'), 'r');
        $csv->setHeaderOffset(0);

        $batchSize = 500;
        $timestamp = now();
        $records = [];
        $counter = 0;

        foreach ($csv->getRecords() as $record) {
            $records[] = [
                'id' => $record['id'],
                'name_id' => $record['name_id'],
                'name' => $record['name'],
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];

            $counter++;

            if ($counter % $batchSize === 0) {
                Nickname::insert($records);
                $records = [];
            }
        }

        if (!empty($records)) {
            Nickname::insert($records);
        }
    }
}

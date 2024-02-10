<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = Reader::createFromPath(base_path('data/imports/genders.csv'));
        $csv->setHeaderOffset(0);

        foreach ($csv as $record) {
            Gender::insert([
                'id' => $record['id'],
                'name' => $record['name'],
                'slug' => $record['slug'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class RedirectSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        $csv = Reader::createFromPath(base_path('data/imports/seo/redirects.csv'), 'r');
        $csv->setHeaderOffset(0);

        foreach ($csv as $record) {
            DB::table('redirects')->updateOrInsert(
                ['source' => $record['source']],
                ['target' => $record['target']]
            );
        }
    }
}

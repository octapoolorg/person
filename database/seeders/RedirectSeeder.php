<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class RedirectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        $csv = Reader::createFromPath(database_path('imports/redirects/bulk.csv'), 'r');
        $csv->setHeaderOffset(0);

        foreach ($csv as $record) {
            DB::table('redirects')->updateOrInsert(
                ['source' => $record['source']],
                ['target' => $record['target']]
            );
        }
    }
}

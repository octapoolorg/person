<?php

namespace Database\Seeders;

use App\Models\Redirect;
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
    public function run(): void
    {
        $csv = Reader::createFromPath(base_path('data/seo/redirects.csv'));
        $csv->setHeaderOffset(0);

        $batchSize = 500;
        $records = [];
        $counter = 0;

        foreach ($csv->getRecords() as $record) {
            $records[] = [
                'source' => $record['source'],
                'target' => $record['target']
            ];

            $counter++;

            if ($counter % $batchSize === 0) {
                Redirect::insert($records);
                $records = [];
            }
        }

        if (! empty($records)) {
            Redirect::insert($records);
        }
    }
}

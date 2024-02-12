<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RedirectSeeder::class,
            GenderSeeder::class,
            NameSeeder::class,
            CategorySeeder::class,
            OriginSeeder::class,
            CategoryNameSeeder::class,
            NameOriginSeeder::class,
            AbbreviationSeeder::class,
        ]);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RedirectSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'waqar@identeez.com'],
            [
                'name' => 'Waqar Hussain',
                'password' => Hash::make('WaQar@s0ftp@k'),
            ]
        );

        $this->call(RedirectSeeder::class);
    }
}

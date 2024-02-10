<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'waqar@identeez.com',
        ], [
            'name' => 'Waqar Hussain',
            'password' => Hash::make('WaQar@75,rSeYn.'),
        ]);
    }
}

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
        User::create([
            'name' => 'Waqar Hussain',
            'email' => 'waqar@identeez.com',
            'password' => Hash::make('WaQar@75,rSeYn.'),
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'ssy99@example.com'],
            [
                'name' => 'Ssy99',
                'password' => Hash::make('0987654')
            ]
        );
    }
}

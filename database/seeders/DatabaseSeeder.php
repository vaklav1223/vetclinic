<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'email' => 'admin@test.kz',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        User::factory()->create([
            'email' => 'editor@test.kz',
            'password' => Hash::make('password'),
            'role' => 'editor',
        ]);
        User::factory()->create([
            'email' => 'user@test.kz',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}

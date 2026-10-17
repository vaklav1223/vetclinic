<?php

namespace Database\Seeders;

use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $owners = Owner::factory()->count(15)->create();

        Pet::factory()->count(40)->create([
            'owner_id' => fn () => $owners->random()->id,
        ]);
    }
}

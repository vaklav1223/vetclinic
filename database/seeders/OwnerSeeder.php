<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OwnerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('owners')->insert([
            ['name' => 'Иван Иванов', 'description' => 'Постоянный клиент, владелец собак', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Мария Петрова', 'description' => 'Любительница редких пород кошек', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Алексей Сидоров', 'description' => 'Заводчик попугаев', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ольга Соколова', 'description' => 'Владелица приюта для грызунов', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

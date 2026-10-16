<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetSeeder extends Seeder
{
    public function run(): void
    {
        // Получаем массив всех сгенерированных id владельцев
        $ownerIds = DB::table('owners')->pluck('id')->toArray();

        DB::table('pets')->insert([
            ['owner_id' => $ownerIds[0], 'title' => 'Шарик', 'breed' => 'Овчарка', 'age' => 6, 'rating' => 5, 'price' => 1500.00, 'is_vaccinated' => true, 'birth_date' => '2020-05-10', 'created_at' => now(), 'updated_at' => now()],
            ['owner_id' => $ownerIds[0], 'title' => 'Бобик', 'breed' => 'Дворняжка', 'age' => 3, 'rating' => 4, 'price' => 800.00, 'is_vaccinated' => true, 'birth_date' => '2023-02-15', 'created_at' => now(), 'updated_at' => now()],
            ['owner_id' => $ownerIds[1], 'title' => 'Мурка', 'breed' => 'Сиамская', 'age' => 2, 'rating' => 5, 'price' => 2000.00, 'is_vaccinated' => false, 'birth_date' => '2024-08-20', 'created_at' => now(), 'updated_at' => now()],
            ['owner_id' => $ownerIds[1], 'title' => 'Барсик', 'breed' => 'Персидская', 'age' => 7, 'rating' => 3, 'price' => 2500.00, 'is_vaccinated' => true, 'birth_date' => '2019-11-01', 'created_at' => now(), 'updated_at' => now()],
            ['owner_id' => $ownerIds[2], 'title' => 'Кеша', 'breed' => 'Волнистый', 'age' => 1, 'rating' => 4, 'price' => 500.00, 'is_vaccinated' => false, 'birth_date' => '2025-01-10', 'created_at' => now(), 'updated_at' => now()],
            ['owner_id' => $ownerIds[2], 'title' => 'Гоша', 'breed' => 'Какаду', 'age' => 8, 'rating' => 5, 'price' => 15000.00, 'is_vaccinated' => true, 'birth_date' => '2018-03-14', 'created_at' => now(), 'updated_at' => now()],
            ['owner_id' => $ownerIds[3], 'title' => 'Хомка', 'breed' => 'Сирийский', 'age' => 1, 'rating' => 4, 'price' => 300.00, 'is_vaccinated' => false, 'birth_date' => '2025-06-01', 'created_at' => now(), 'updated_at' => now()],
            ['owner_id' => $ownerIds[3], 'title' => 'Пушок', 'breed' => 'Шиншилла', 'age' => 4, 'rating' => 5, 'price' => 4500.00, 'is_vaccinated' => true, 'birth_date' => '2022-09-17', 'created_at' => now(), 'updated_at' => now()],
            ['owner_id' => $ownerIds[0], 'title' => 'Рекс', 'breed' => 'Лабрадор', 'age' => 5, 'rating' => 5, 'price' => 3000.00, 'is_vaccinated' => true, 'birth_date' => '2021-04-05', 'created_at' => now(), 'updated_at' => now()],
            ['owner_id' => $ownerIds[1], 'title' => 'Пушинка', 'breed' => 'Сфинкс', 'age' => 3, 'rating' => 4, 'price' => 5000.00, 'is_vaccinated' => true, 'birth_date' => '2023-10-12', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

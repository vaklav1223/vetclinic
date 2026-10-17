<?php

namespace Database\Factories;

use App\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    public function definition(): array
    {
        return [
            'owner_id' => Owner::factory(),
            'title' => fake()->randomElement([
                'Шарик', 'Бобик', 'Мурка', 'Барсик', 'Рекс', 
                'Хатико', 'Арчи', 'Грей', 'Белка', 'Стрелка', 
                'Пушок', 'Жучка', 'Зевс', 'Цезарь', 'Оскар'
            ]),
            'breed' => fake()->randomElement(['Лабрадор', 'Персидский', 'Сиамский', 'Овчарка', null]),
            'age' => fake()->numberBetween(0, 15),
            'price' => fake()->randomFloat(2, 500, 50000),
            'is_vaccinated' => fake()->boolean(70),
            'birth_date' => fake()->dateTimeBetween('-1 year', '+1 year')->format('Y-m-d'),
        ];
    }
}

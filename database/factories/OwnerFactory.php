<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OwnerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name(),
            'phone' => fake()->phoneNumber(),
            'description' => fake()->sentence(),
        ];
    }
}

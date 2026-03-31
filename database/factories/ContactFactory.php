<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'company' => fake()->company(),
            'tag' => fake()->randomElement(['prospect', 'customer', 'vip']),
            'status' => 'active',
            'source' => fake()->randomElement(['import', 'manual', 'api']),
            'country' => fake()->countryCode(),
            'notes' => fake()->sentence(),
        ];
    }
}

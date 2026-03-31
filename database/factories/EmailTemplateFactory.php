<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmailTemplateFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(2),
            'category' => fake()->randomElement(['Promotional', 'Newsletter', 'Transactional']),
            'subject' => fake()->sentence(5),
            'html_body' => '<h1>Hello {{first_name}}</h1><p>Thanks for staying with us.</p>',
            'is_active' => true,
        ];
    }
}

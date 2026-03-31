<?php

namespace Database\Factories;

use App\Models\EmailTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'subject' => fake()->sentence(5),
            'sender_name' => 'Marketing Team',
            'sender_email' => 'marketing@example.com',
            'type' => fake()->randomElement(['regular', 'scheduled', 'draft']),
            'status' => fake()->randomElement(['draft', 'scheduled', 'sent']),
            'email_template_id' => EmailTemplate::query()->inRandomOrder()->value('id'),
            'scheduled_at' => fake()->optional()->dateTimeBetween('+1 day', '+30 days'),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'description' => fake()->paragraph,
            'event_date' => fake()->dateTimeBetween('+1 week', '+6 months'),
            'location' => fake()->city,
            'capacity' => rand(10, 100),
            'current_registrations_count' => 0,
            'status' => collect(['draft', 'published', 'cancelled'])->random(),
        ];

    }
}

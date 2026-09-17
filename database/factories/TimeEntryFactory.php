<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TimeEntry>
 */
class TimeEntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startedAt = $this->faker->dateTimeBetween('-30 days');

        return [
            'user_id' => User::factory(),
            'project_id' => Project::factory(),
            'started_at' => $startedAt,
            'ended_at' => (clone $startedAt)->modify('+'.rand(1, 8).' hours'),
            'note' => $this->faker->optional()->sentence(),
        ];
    }

    /**
     * Indicate that the entry is still running.
     */
    public function running(): static
    {
        return $this->state(fn (array $attributes) => [
            'ended_at' => null,
        ]);
    }
}

<?php

namespace Database\Factories\Project;

use App\Enums\Project\ProjectPriority;
use App\Enums\Project\ProjectStatus;
use App\Models\Project\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_name' => fake()->company(),
            'project_name' => fake()->catchPhrase(),
            'description' => fake()->paragraph(),

            'status' => fake()->randomElement(ProjectStatus::cases()),
            'priority' => fake()->randomElement(ProjectPriority::cases()),

            'start_date' => fake()->dateTimeBetween('-3 months', 'now'),
            'due_date' => fake()->dateTimeBetween('now', '+6 months'),

            'user_id' => User::factory(),
        ];
    }
}

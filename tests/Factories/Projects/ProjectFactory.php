<?php

namespace Tests\Factories\Projects;

use App\Enums\Project\ProjectPriority;
use App\Enums\Project\ProjectStatus;
use App\Models\Project\Project;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Foundation\Testing\WithFaker;

class ProjectFactory
{
    public function createProject(int $size = 1, array $overrides = []): Collection
    {
        return Project::factory($size)->create($overrides);
    }

    public function genenrateProjectDummyData(int $user_id = 0): array
    {
        $startDate = new \DateTimeImmutable(
        fake()->date('Y-m-d')
        );

        $dueDate = $startDate->modify(
            '+' . fake()->numberBetween(0, 180) . ' days'
        );
        return [
            'client_name' => fake()->company(),
            'project_name' => fake()->catchPhrase(),
            'description' => fake()->paragraph(),

            'status' => fake()->randomElement(ProjectStatus::cases())->value,
            'priority' => fake()->randomElement(ProjectPriority::cases())->value,

            'start_date' => $startDate->format('Y-m-d'),
            'due_date' => $dueDate->format('Y-m-d'),
            'user_id' => $user_id
        ];
    }
}
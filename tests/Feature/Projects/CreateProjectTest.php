<?php

namespace Tests\Feature\Projects;

use Tests\Factories\Projects\ProjectFactory;
use Tests\Factories\Users\UserFactory;
use Tests\TestCase;

class CreateProjectTest extends TestCase
{
    private $url = '/api/v1/projects';
    private $user;
    private $project;
    private $projectFactory;

    public function setUp(): void
    {
        parent::setUp();

        $userFactory = new UserFactory();
        $this->user = $userFactory->createUser();
        $this->actingAs($this->user);

        $this->projectFactory = new ProjectFactory();
        $this->project = $this->projectFactory->genenrateProjectDummyData($this->user->id);
    }

    public function test_create_project(): void
    {
        $this->withoutExceptionHandling();
        $this->postJson($this->url, $this->project)->assertCreated();

        $this->assertDatabaseHas('projects',[
            'project_name' => $this->project['project_name']
        ]);
    }
    
    public function test_required_fields_project_validation(): void
    {
        $requiredFields = ['client_name', 'project_name', 'status', 'priority', 'start_date', 'due_date'];

        foreach ($requiredFields as $field) {
            $response = $this->postRequest($this->project, $field, $this->url);

            $response->assertUnprocessable();
            $response->assertJsonValidationErrors([$field]);
        }
    }

    public function test_project_status_is_not_valid(): void
    {
        $this->enumChecker('status');
    }

    public function test_project_priority_is_not_valid(): void
    {
       $this->enumChecker('priority');
    }

    private function enumChecker(string $field): void
    {
         $this->project[$field] = fake()->text();

        $this->postJson($this->url, $this->project)
            ->assertUnprocessable()
            ->assertJsonValidationErrors([$field]);
    }

    public function test_due_date_cannot_be_before_start_date(): void
    {
        $this->project['start_date'] = '2026-09-10';
        $this->project['due_date'] = '2026-09-09';

        $this->postJson($this->url, $this->project)
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['due_date']);
    }

}

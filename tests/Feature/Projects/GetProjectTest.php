<?php

namespace Tests\Feature\Projects;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Factories\Projects\ProjectFactory;
use Tests\Factories\Users\UserFactory;
use Tests\TestCase;

class GetProjectTest extends TestCase
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
    }
    public function test_get_projects(): void
    {
        $this->projectFactory->createProject(5);
    
        $response = $this->getJson($this->url)->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'client_name',
                    'project_name',
                    'description',
                    'status',
                    'priority',
                    'start_date',
                    'due_date',
                    'user_id',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);
    }

    public function test_get_project_by_id(): void
    {
        $this->withoutExceptionHandling();
        $project = $this->projectFactory->createProject()->first();

        $response = $this->getJson($this->url . '/' . $project->id)
        ->assertStatus(200);
    }
    public function test_get_projects_with_pagination(): void
    {
        $this->projectFactory->createProject(15);

        $response = $this->getJson(  $this->url . '?per_page=5')->assertStatus(200);

        $response->assertJsonCount(5, 'data')
            ->assertJsonPath('meta.current_page', 1)
            ->assertJsonPath('meta.per_page', 5)
            ->assertJsonPath('meta.total', 15)
            ->assertJsonPath('meta.last_page', 3);
    }

    public function test_search_projects(): void
    {
        $this->projectFactory->createProject(1, [
            'project_name' => 'Laravel PMS',
        ]);

        $this->projectFactory->createProject(1, [
            'project_name' => 'Vue Application',
        ]);

        $response = $this->getJson($this->url . '?search=Laravel')->assertStatus(200);

        $response->assertJsonCount(1, 'data')
            ->assertJsonPath(
                'data.0.project_name',
                'Laravel PMS'
            );
    }

    public function test_filter_projects_by_status(): void
    {
        $this->projectFactory->createProject(10, [
            'status' => 'Pending'
        ]);

        $response = $this->getJson($this->url . '?status=Pending')->assertStatus(200);

        $response->assertJsonCount(10, 'data');
    }

    public function test_filter_projects_by_priority(): void
    {
        $this->projectFactory->createProject(10, [
            'priority' => 'high'
        ]);

        $response = $this->getJson($this->url . '?priority=high')->assertStatus(200);

        $response->assertJsonCount(10, 'data');
    }
}

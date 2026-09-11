<?php

namespace Tests\Feature\Projects;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Factories\Projects\ProjectFactory;
use Tests\Factories\Users\UserFactory;
use Tests\TestCase;

class UpdateProjectTest extends TestCase
{
    private $url = '/api/v1/projects';
    private $user;
    private $projectFactory;

    public function setUp(): void
    {
        parent::setUp();

        $userFactory = new UserFactory();
        $this->user = $userFactory->createUser();

        $this->actingAs($this->user);
        $this->projectFactory = new ProjectFactory();
    }

    public function test_update_project(): void
    {
        $existingProject = $this->projectFactory->createProject(1, ['user_id' => $this->user->id])->first();
        $project = $this->projectFactory->genenrateProjectDummyData($this->user->id);

        $this->putJson($this->url . '/' . $existingProject->id, $project)
        ->assertStatus(200);

        $this->assertDatabaseHas('projects', [
            'project_name' => $project['project_name']
        ]);
    }
}

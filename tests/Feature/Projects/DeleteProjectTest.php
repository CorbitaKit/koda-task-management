<?php

namespace Tests\Feature\Projects;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Factories\Projects\ProjectFactory;
use Tests\Factories\Users\UserFactory;
use Tests\TestCase;

class DeleteProjectTest extends TestCase
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

    public function test_delete_project(): void
    {
        $this->withoutExceptionHandling();
        $project = $this->projectFactory->createProject(1, ['user_id' => $this->user->id])->first();

        $this->deleteJson($this->url . '/' . $project->id)
        ->assertStatus(200);
        $this->assertSoftDeleted('projects', [
            'id' => $project->id
        ]);
    }

}

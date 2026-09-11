<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Factories\Users\UserFactory;
use Tests\TestCase;


class AuthTest extends TestCase
{
    private $url = '/api/v1/login';
    private UserFactory $userFactory;
    private $user;
    private $password;
    public function setUp(): void
    {
        parent::setUp();

        $this->userFactory = new UserFactory();
        $this->password = fake()->password();
        $this->user = $this->userFactory->createUser(['password' => $this->password]);
    }

    public function test_user_can_login(): void
    {
        $response = $this->postJson($this->url, [
            'email' => $this->user->email,
            'password' => $this->password
        ])->assertStatus(200);

        $response->assertJsonStructure([
            'message',
            'user',
            'success',
            'token'
        ]);
    }

    public function test_user_cannot_login(): void
    {
        $this->postJson($this->url, [
            'email' => fake()->email(),
            'password' => fake()->password()
        ])->assertStatus(403);
    }

    public function test_login_required_fields_validation(): void
    {
        $requiredFields = ['email', 'password'];

        foreach ($requiredFields as $field) {
            $response = $this->postRequest($this->user->toArray(), $field, $this->url);
            $response->assertUnprocessable();
        }
    }

    public function test_login_email_format_validation(): void
    {
        $this->user['email'] = fake()->sentence();
        
        $response = $this->postJson($this->url, $this->user->toArray());
        $response->assertUnprocessable();
    }


   
}

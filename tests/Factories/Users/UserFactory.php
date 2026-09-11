<?php

namespace Tests\Factories\Users;

use App\Models\User;

class UserFactory
{
    public function createUser(array $overrides = []): User
    {
        return User::factory()->create($overrides);
    }
}
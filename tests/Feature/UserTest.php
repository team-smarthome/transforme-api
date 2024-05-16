<?php

namespace Tests\Feature;

use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCreation(): void
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', [
            'username' => $user->username,
            'password' => $user->password,
            'name' => $user->name,
        ]);
    }
}
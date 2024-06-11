<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_example(): void
    {
        $this->assertTrue(true);
    }
    /**
     * A basic feature test example.
     */
    public function test_login(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'mahmoud@sprints.ai',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'access_token',
            'token_type',
        ]);
    }

    public function test_create_user(): void
    {
        $user = User::factory()->create([
            'name' => 'test user',
            'email' => 'testuser@example.com',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'test user',
            'email' => 'testuser@example.com',
        ]);

        $user->delete();
    }
}

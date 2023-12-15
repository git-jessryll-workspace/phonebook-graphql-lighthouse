<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginApiTest extends TestCase
{
    public function testUserLogin()
    {
        // Create a user for testing (adjust the factory to match your User model)
        $user = \App\Models\User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // Use the actual password set in the factory
        ]);

        // Send a request to login
        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password', // Use the actual password set in the factory
        ]);

        // Assert the response structure and values
        $response->assertJsonStructure([
            'status',
            'message',
            'token',
        ])->assertJson([
            'status' => true,
            'message' => 'User Logged In Successfully',
        ]);

    }
}

<?php

namespace Tests\Feature;

use App\Services\LoginApiService;
use Illuminate\Http\Request;
use Tests\TestCase;

class LoginApiTest extends TestCase
{
    public function testLoginWithValidCredentials()
    {
        $user = \App\Models\User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // Use the actual password set in the factory
        ]);

        $loginApiService = new LoginApiService();

        $request = new Request([
            'email' => 'test@example.com',
            'password' => 'password', // Use the actual password set in the factory
        ]);

        $response = $loginApiService->login($request);

        $responseContent = json_decode($response->getContent(), true);

        $this->assertTrue($responseContent['status']);
        $this->assertEquals('User logged in successfully', $responseContent['message']);
        $this->assertArrayHasKey('token', $responseContent['data']);
    }

    public function testLoginWithInvalidCredentials()
    {
        $loginApiService = new LoginApiService();

        $request = new Request([
            'email' => 'invalid@example.com',
            'password' => 'invalidpassword',
        ]);

        $response = $loginApiService->login($request);

        $responseContent = json_decode($response->getContent(), true);

        $this->assertFalse($responseContent['status']);
        $this->assertEquals('Email & Password do not match our records.', $responseContent['message']);
        $this->assertNull($responseContent['data']);
    }
}

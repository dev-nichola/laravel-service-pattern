<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(UserService::class);
    }

    public function testSample()
    {
        self::assertTrue(true);
    }

    public function testLoginSuccess()
    {
        self::assertTrue($this->service->login('nichola', 'rahasia'));
    }

    public function testLoginNotFound()
    {
        self::assertFalse($this->service->login('Niko', 'rahasia'));
    }

    public function testLoginFailed()
    {
        self::assertFalse($this->service->login('nichola', 'password'));
    }


}

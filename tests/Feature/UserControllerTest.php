<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testlogin()
    {
        $this->get('/login')
        ->assertSeeText('Login');
    }

    public function testLoginForMember()
    {
        $this->withSession([
            "user" => 'nichola'
        ])
        ->get('/login')
        ->assertRedirect('/')
        ->assertSessionHas('user', 'nichola');

    }

    public function testLoginForMemberAlreadyLogin()
    {
        $this->withSession([
            "user" => 'nichola'
        ])
        ->post('/login', [
            'user' => 'nichola',
            'password' => 'rahasia'
        ])
        ->assertRedirect('/');

    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            "user" => "nichola",
            "password" => "rahasia"
        ])->assertRedirect("/")
        ->assertSessionHas('user', 'nichola');
    }

    public function testLoginValidationError()
    {
        $this->post('/login')->assertSeeText('User Or Password Is Requered');
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            'user' => 'wrong',
            'password' => "wrong`"
        ])
        ->assertSeeText('User Or Password Is Wrong');
    }

    public function testLogout()
    {
        $this->post('/logout')
        ->assertSessionMissing('user')
        ->assertRedirect('/');
    }

    public function testLogoutMember()
    {
        $this->post('/logout')
        ->assertRedirect('/');
    }




}

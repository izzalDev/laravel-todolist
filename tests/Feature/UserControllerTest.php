<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage(){
        $this->get('login')
            ->assertSeeText("Login");
    }

    public function testLoginSuccess(){
        $this->post('/login',[
            'user'=>'izzal',
            'password'=>'rizal123'
        ])->assertRedirect('/')
            ->assertSessionHas('user','izzal');
    }

    public function testLoginValidationError(){
        $this->post('login',[])
            ->assertSeeText('User or password is required');
    }

    public function testLoginFailed(){
        $this->post('login', [
            'user'=>'wrong',
            'password'=>'wrong',
        ])->assertSeeText('User or password wrong');
    }

    public function testLogout(){
         $this->withSession([
             'user'=>'izzal',
         ])->post('logout')
             ->assertRedirect('/login')
             ->assertSessionMissing('user');
    }
}

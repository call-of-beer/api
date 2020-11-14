<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{

    use RefreshDatabase, WithFaker;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->artisan('db:seed'); //by stworzyć role
    }

    public function test_user_can_login_with_proper_credentials()
    {
        //$this->withoutExceptionHandling();
        
        $user = \App\Models\User::factory()->create([
            'email' => '11essmaidsdsddl@example.com',
            'password' => Hash::make('secret')      //zahaszowane hasło, bez tego nie przechodzi
        ]);


        $response = $this->json('POST', '/api/login', [
            'email' => '11essmaidsdsddl@example.com',
            'password' => 'secret'
        ]);

        $response->assertStatus(200);
        //dump($response->getContent());

    }

    public function test_user_cant_login_with_proper_credentials()
    {
        //$this->withoutExceptionHandling();
        
        $user = \App\Models\User::factory()->create([
            'email' => '11essmaidsdsddl@example.com',
            'password' => Hash::make('secret')      
        ]);


        $response = $this->json('POST', '/api/login', [
            'email' => '11essmaidsdsddl@example.com',
            'password' => 'innehaslo'
        ]);

        $response->assertStatus(401);
        //dump($response->getContent());

    }
}

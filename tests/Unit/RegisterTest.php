<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
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

    public function test_user_can_register_with_proper_credentials()
    {

        $this->withoutExceptionHandling();

        $user = [
            'firstname' => 'Iyish',
            'surname' => 'Smith',
            'email' => 'exp@exp.com',
            'password' => 'qwertyui',
            'password_confirmation' => 'qwertyui',
        ];

        $response = $this->json('POST', '/api/register', $user);

        $response->assertStatus(200);

        
         //dump($response->getContent());

        
        $response = $this->assertDatabaseHas('users', ['email' => $user['email']]);

    }


    public function test_guest_cannot_register_with_empty_fields()
    {

        $user = [];

        $response = $this->json('POST', '/api/register', $user);

        $response->assertStatus(422);
                    
    }


    public function test_guest_cannot_register_with_wrong_email()
    {

        $user = [
            'name' => 'Iyish',
            'surname' => 'Smith',
            'email' => 'exp',
            'password' => 'qwertry',
            'password_confirmation' => 'qwertry',
        ];

        $response = $this->json('POST', '/api/register', $user);

        $response->assertStatus(422);

    }

    public function test_guest_cannot_register_with_wrong_password_confirmation()
    {

        $user = [
            'name' => 'Iyish',
            'surname' => 'Smith',
            'email' => 'exp@xp.com',
            'password' => 'P@Puda2324',
            'password_confirmation' => 'P@Puda232',
        ];

        $response = $this->json('POST', '/api/register', $user);

        $response->assertStatus(422);

    }
}

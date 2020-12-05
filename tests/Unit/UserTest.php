<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;


class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $book;
    protected $admin;
    protected $user;

    public function setUp() :void
    {
        parent::setUp();

        $this->artisan('db:seed');

        $this->user= \App\Models\User::factory()->create();
        $this->user->assignRole('drinker');
        
        $this->user2= \App\Models\User::factory()->create();
        $this->user2->assignRole('drinker');

        $this->admin= \App\Models\User::factory()->create();
        $this->admin->assignRole('admin');

    }

    public function test_add_user()
    {
        // /$this->withoutExceptionHandling();
        $this->actingAs($this->admin);
        
        $response = $this->withHeaders(['Accept' => 'application/json'])
        ->json('post', "api/user/add", [
            'firstname' => 'Ella',
            'surname' => 'Smith',
            'email' => 'exp@exp.com',
            'password' => 'qwertyui',
            'password_confirmation' => 'qwertyui',
            'role'=>'drinker',
        ])
        ->assertStatus(201);
        dump($response->getContent());

        $response = $this->assertDatabaseHas('users', ['surname' => 'Smith']);
    }

    public function test_get_one_specific_user()
    {
        $user= \App\Models\User::factory()->create();

        $this->actingAs($this->user);

        $response = $this->json('get', "api/user/$user->id")
        ->assertStatus(201);
       //dump($response->getContent());

    }

    public function test_get_users()
    {
       // $this->withoutExceptionHandling();
        $user= \App\Models\User::factory()->create();

        $this->actingAs($this->user);

        $response = $this->json('get', "api/users")
        ->assertStatus(201);
        dump($response->getContent());

    }

    public function test_edit_user_by_user()
    {
        $user= $this->user;

        $this->actingAs($this->user);

        
        $response = $this->json('PATCH', "api/user/$user->id/edit", [
            'firstname'=>'Anna',
            'email' => 'aaa@wp.pl'
        ])
        ->assertStatus(200);
        dump($response->getContent());
        $response = $this->assertDatabaseHas('users', ['firstname' => 'Anna']);
        $response = $this->assertDatabaseHas('users', ['email' => 'aaa@wp.pl']);

    }

    public function test_edit_user_if_admin()
    {
        $this->withoutExceptionHandling();
        $user= \App\Models\User::factory()->create();
        $firstname = $user->firstname;

        $this->actingAs($this->admin);
        
        $this->admin->assignRole('admin');
        
        $response = $this->json('PATCH', "api/user/$user->id/edit", [
            'firstname'=>'Anna',
            'email' => 'aaa@wp.pl'
        ])
        ->assertStatus(200);
        dump($response->getContent());
        $response = $this->assertDatabaseMissing('users', ['firstname' => $firstname]);
        $response = $this->assertDatabaseHas('users', ['firstname' => 'Anna']);
        $response = $this->assertDatabaseHas('users', ['email' => 'aaa@wp.pl']);

    }

    public function test_cant_edit_user()
    {
        $user= \App\Models\User::factory()->create();
        $user2= \App\Models\User::factory()->create();

        $this->actingAs($this->user2);

        $response = $this->json('PATCH', "api/user/$user->id/edit", [
            'firstname'=>'Anna',
            'email' => 'aaa@wp.pl'
        ])
        ->assertStatus(401);

        dump($response->getContent());
        $response = $this->assertDatabaseMissing('users', ['firstname' => 'Anna']);
        $response = $this->assertDatabaseMissing('users', ['email' => 'aaa@wp.pl']);

    }

    public function test_cant_edit_user_if_email_used()
    {
        $user2= \App\Models\User::factory()->create([
            'email' => 'aaa@wp.pl'
        ]);

        $this->actingAs($this->user);

        $user = $this->user;

        $response = $this->json('PATCH', "api/user/$user->id/edit", [
            'firstname'=>'Anna',
            'email' => 'aaa@wp.pl'
        ])
        ->assertStatus(422);
        dump($response->getContent());
        $response = $this->assertDatabaseMissing('users', ['firstname' => 'Anna']);

    }

    public function test_delete_user()
    {
        $this->actingAs($this->admin);

        $user=$this->user;

        $response = $this->json('DELETE', "api/user/delete/$user->id")
        ->assertStatus(200);
       //dump($response->getContent());

       $response = $this->assertDatabaseMissing('users', ['id' => $user['id']]);

    }

    public function test_delete_user_as_user()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user);

        $user=$this->user;

        $response = $this->withHeaders(['Accept' => 'application/json'])
        ->json('DELETE', "api/user/delete/$user->id")
        ->assertStatus(200);
       dump($response->getContent());

       $response = $this->assertDatabaseMissing('users', ['id' => $user['id']]);

    }


    public function test_can_not_delete_user_as_other_user()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user2);

        $user=$this->user;

        $response = $this->withHeaders(['Accept' => 'application/json'])
        ->json('DELETE', "api/user/delete/$user->id")
        ->assertStatus(401);
       dump($response->getContent());

       $response = $this->assertDatabaseHas('users', ['id' => $user['id']]);

    }
    
}

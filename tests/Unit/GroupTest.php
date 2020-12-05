<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Group;
use App\Models\User;

class GroupTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->artisan('db:seed'); //by stworzyć role

        $this->admin= \App\Models\User::factory()->create();
        $this->admin->assignRole('admin');

        $this->drinker= \App\Models\User::factory()->create();
        $this->drinker->assignRole('drinker');

        $this->user= \App\Models\User::factory()->create([
            'email' => 'abc@wp.pl'
        ]);
        $this->user->assignRole('drinker');

        $this->user2= \App\Models\User::factory()->create([
            'email' => 'abcd@wp.pl'
        ]);
        $this->user2->assignRole('drinker');

        $this->group = \App\Models\Group::factory()->create([
            'name' => 'Lol',
            'moderator_id' => $this->user->id,
        ]);

        $this->group2 = \App\Models\Group::factory()->create([
            'moderator_id' => $this->user->id,
        ]);



    }



    //STORE


    public function test_can_add_new_group_as_user()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->drinker);

        $response = $this->json('POST',"/api/group/add", [
            'name' => 'Herosi'
        ]);

        $response->assertStatus(200);

        dump($response->getContent());

    }

    public function test_can_add_new_group_as_admin()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->admin);

        $response = $this->json('POST',"/api/group/add", [
            'name' => 'Herosi2'
        ]);

        $response->assertStatus(200);

        dump($response->getContent());

    }


    public function test_can_not_add_new_group_if_unauthorized()
    {
        //$this->withoutExceptionHandling();

        $response = $this->json('POST',"/api/group/add", [
            'name' => 'Herosi3'
        ]);

        $response->assertStatus(403);

        //dump($response->getContent());

    }

    public function test_user_which_create_group_is_member_in_it()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->drinker);

        $user=$this->drinker;

        $response = $this->json('POST',"/api/group/add", [
            'name' => 'Herosi'
        ]);

        $response->assertStatus(200);

        dump($response->getContent());

        $group = Group::where('name', 'Herosi')->first();

        $response = $this->assertDatabaseHas('group_user',['user_id' => $user->id, 'group_id' => "$group->id"]);

    }






    //UPDATE


    public function test_update_group_as_moderator_of_a_group()
    {
        $this->actingAs($this->user);
        $group = $this->group;

        $response = $this->json('PUT',"/api/group/update/$group->id", [
            'name' => 'Piwosze'
        ]);

        $response->assertStatus(200);

        dump($response->getContent());

        $response = $this->assertDatabaseMissing('groups',['name' => $group->name]);
        $response = $this->assertDatabaseHas('groups',['name' => 'Piwosze']);

    }

    public function test_can_not_update_group_with_wrong_credentials()
    {
        $this->actingAs($this->user);
        $group = $this->group;

        $response = $this->json('PUT',"/api/group/update/$group->id", [
            'name' => ''
        ]);

        $response->assertStatus(422);

        dump($response->getContent());

        $response = $this->assertDatabaseHas('groups',['name' => $group->name]);

    }

    public function test_can_not_update_group_as_moderator_of_other_group()
    {
        //$this->withoutExceptionHandling();

        $this->actingAs($this->user2);
        $group = $this->group;

        $response = $this->json('PUT',"/api/group/update/$group->id", [
            'name' => 'Piwosze2'
        ]);

        $response->assertStatus(401);

        //dump($response->getContent());

        $response = $this->assertDatabaseHas('groups',['name' => $group->name]);
        $response = $this->assertDatabaseMissing('groups',['name' => 'Piwosze2']);

    }

    public function test_can_update_group_as_admin()
    {
        $this->actingAs($this->admin);
        $group = $this->group;

        $response = $this->json('PUT',"/api/group/update/$group->id", [
            'name' => 'Piwosze3'
        ]);

        $response->assertStatus(200);

        dump($response->getContent());

        $response = $this->assertDatabaseMissing('groups',['name' => $group->name]);
        $response = $this->assertDatabaseHas('groups',['name' => 'Piwosze3']);

    }

    public function test_can_not_update_group_as_unlogged_user()
    {
        $group = $this->group;

        $response = $this->json('PUT',"/api/group/update/$group->id", [
            'name' => 'Piwosze2'
        ]);

        $response->assertStatus(403);

        //dump($response->getContent());

        $response = $this->assertDatabaseHas('groups',['name' => $group->name]);
        $response = $this->assertDatabaseMissing('groups',['name' => 'Piwosze2']);

    }




    //DELETE
    
    public function test_deleting_group_as_moderator(){

        $this->withoutExceptionHandling();

        $this->actingAs($this->user);

        $group = $this->group;

        $user = $this->user2;

        $response = $this->json('POST',"/api/group/add", [
            'name' => 'Herosi'
        ]);

        $response = $this->json('POST',"/api/group/$group->id/addUser", [
            'email' => $this->user2->email,
        ]);

        $response = $this->json('POST',"/api/group/$group->id/addUser", [
            'email' => 'abc@wp.pl'
        ]);

        $response = $this->json('DELETE',"/api/group/delete/$group->id");

        $response->assertStatus(200);


        dump($response->getContent());
        
        

        $response = $this->assertDatabaseMissing('group_user',['group_id' => $group->id]);
        $response = $this->assertDatabaseMissing('group_user',['user_id' => $user->id]);
        
    }


    public function test_deleting_group_as_admin(){

        $this->withoutExceptionHandling();

        $this->actingAs($this->admin);

        $group = $this->group;

        $user = $this->user2;

        $response = $this->json('POST',"/api/group/add", [
            'name' => 'Herosi'
        ]);

        $response = $this->json('POST',"/api/group/$group->id/addUser", [
            'email' => $this->user2->email,
        ]);

        $response = $this->json('POST',"/api/group/$group->id/addUser", [
            'email' => 'abc@wp.pl'
        ]);

        $response = $this->json('DELETE',"/api/group/delete/$group->id");

        $response->assertStatus(200);


        dump($response->getContent());
        
        

        $response = $this->assertDatabaseMissing('group_user',['group_id' => $group->id]);
        $response = $this->assertDatabaseMissing('group_user',['user_id' => $user->id]);
        
    }


    public function test_can_not_delete_group_as_moderator_other_group(){

        $this->withoutExceptionHandling();

        $this->actingAs($this->user);

        $group = $this->group;

        $user = $this->user2;


        $response = $this->json('POST',"/api/group/$group->id/addUser", [
            'email' => $this->user2->email,
        ]);

        $response = $this->json('POST',"/api/group/$group->id/addUser", [
            'email' => 'abc@wp.pl'
        ]);


        $this->actingAs($this->user2);

        $response = $this->json('DELETE',"/api/group/delete/$group->id");

        $response->assertStatus(401);


        dump($response->getContent());
        
        

        $response = $this->assertDatabaseHas('group_user',['group_id' => $group->id]);
        $response = $this->assertDatabaseHas('group_user',['user_id' => $user->id]);
        
    }

    public function test_can_not_delete_group_as_unlogged_user(){

        
        $group = $this->group;

        $response = $this->json('DELETE',"/api/group/delete/$group->id");

        $response->assertStatus(403);


        //dump($response->getContent());
        
    }





    //GET


    public function test_get_all_groups()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->user);

        $response = $this->json('GET', "api/group/all");
        $response->assertStatus(200);

        dump($response->getContent());

    }

    public function test_get_one_specific_group()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->user);

        $group=$this->group;

        $response = $this->json('POST',"/api/group/$group->id/addUser", [
            'email' => 'abc@wp.pl'
        ]);


        $response = $this->json('GET', "api/group/$group->id");
        $response->assertStatus(200);

        dump($response->getContent());

    }

    public function test_can_not_get_one_specific_group_if_not_logged_in()
    {

        //$this->actingAs($this->user);

        $group=$this->group;

        $response = $this->json('POST',"/api/group/$group->id/addUser", [
            'email' => 'abc@wp.pl'
        ]);


        $response = $this->json('GET', "api/group/$group->id");
        $response->assertStatus(403);

       // dump($response->getContent());

    }

    public function test_user_get_his_all_groups_where_is_member()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->user);

        $user = $this->user;

        $group=$this->group;

        $response = $this->json('POST',"/api/group/$group->id/addUser", [
            'email' => 'abc@wp.pl'
        ]);


        $response = $this->json('GET', "/api/user/$user->id/group/all/");
        $response->assertStatus(200);

        dump($response->getContent());

    }







    
    //ADD TO GROUP

    public function test_add_user_to_group()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->user);

        $group = $this->group;

        $response = $this->json('POST',"/api/group/$group->id/addUser", [
            'email' => 'abc@wp.pl'
        ]);

        $response->assertStatus(200);

        dump($response->getContent());

        $user =$this->user;
        
        $response = $this->assertDatabaseHas('group_user',['user_id' => "$user->id"]);
        $response = $this->assertDatabaseHas('group_user',['group_id' => "$group->id"]);
        
    }

    public function test_cant_add_user_to_group_if_already_in_it()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->user);

        $group = $this->group;

        $response = $this->json('POST',"/api/group/$group->id/addUser", [
            'email' => 'abc@wp.pl'
        ]);

        $response = $this->json('POST',"/api/group/$group->id/addUser", [
            'email' => 'abc@wp.pl'
        ]);

        $response->assertStatus(400);

        dump($response->getContent());

        $user =$this->user;
        $response = $this->assertDatabaseHas('group_user',['user_id' => "$user->id"]);
        
    }





    //DELETE FROM GROUP

    public function test_delete_user_from_group_as_moderator()
    {
        //$this->withoutExceptionHandling();

        $this->actingAs($this->user, 'api');

        $group = $this->group;

        $user= $this->drinker;
        

        $response = $this->json('POST',"/api/group/$group->id/addUser", [
            'email' => $user->email
        ]);


        $response = $this->json('DELETE',"/api/group/$group->id/$user->id/delete");

        $response->assertStatus(200);

        dump($response->getContent());

        $response = $this->assertDatabaseMissing('group_user',['user_id' => $user->id, 'group_id' => "$group->id"]);
        $response = $this->assertDatabaseHas('users',['id' => $user->id]);
        $response = $this->assertDatabaseHas('groups',['id' => "$group->id"]);
        
    }

    public function test_delete_user_from_group_as_admin()
    {
        //$this->withoutExceptionHandling();

        $this->actingAs($this->admin);

        $group = $this->group;

        $user= $this->drinker;
        

        $response = $this->json('POST',"/api/group/$group->id/addUser", [
            'email' => $user->email
        ]);


        $response = $this->json('DELETE',"/api/group/$group->id/$user->id/delete");

        $response->assertStatus(200);

        dump($response->getContent());

        $response = $this->assertDatabaseMissing('group_user',['user_id' => $user->id, 'group_id' => "$group->id"]);
        $response = $this->assertDatabaseHas('users',['id' => $user->id]);
        $response = $this->assertDatabaseHas('groups',['id' => "$group->id"]);
        
    }


    public function test_user_can_delete_himself_grom_group()
    {
        //$this->withoutExceptionHandling();

        $this->actingAs($this->user);

        $group = $this->group;

        $user= $this->drinker;
        

        $response = $this->json('POST',"/api/group/$group->id/addUser", [
            'email' => $user->email
        ]);

        $this->actingAs($this->drinker);

        $response = $this->json('DELETE',"/api/group/$group->id/$user->id/delete");

        $response->assertStatus(200);

        dump($response->getContent());

        $response = $this->assertDatabaseMissing('group_user',['user_id' => $user->id, 'group_id' => "$group->id"]);
        $response = $this->assertDatabaseHas('users',['id' => $user->id]);
        $response = $this->assertDatabaseHas('groups',['id' => "$group->id"]);
        
    }

    public function test_can_not_delete_user_from_group_as_moderator_of_other_group()
    {
        //$this->withoutExceptionHandling();

        $this->actingAs($this->user, 'api');

        $group = $this->group;

        $user= $this->drinker;
        

        $response = $this->json('POST',"/api/group/$group->id/addUser", [
            'email' => $user->email
        ]);

        $this->actingAs($this->user2, 'api');

        $response = $this->json('DELETE',"/api/group/$group->id/$user->id/delete");

        $response->assertStatus(401);

        dump($response->getContent());

        $response = $this->assertDatabaseHas('group_user',['user_id' => $user->id, 'group_id' => "$group->id"]);
        $response = $this->assertDatabaseHas('users',['id' => $user->id]);
        $response = $this->assertDatabaseHas('groups',['id' => "$group->id"]);
        
    }

    public function test_can_not_delete_user_from_group_as_unlogged_user()
    {
        $group = $this->group;

        $user= $this->drinker;
        
        $response = $this->json('DELETE',"/api/group/$group->id/$user->id/delete");

        $response->assertStatus(403);

       // dump($response->getContent());
        
    }

    
}

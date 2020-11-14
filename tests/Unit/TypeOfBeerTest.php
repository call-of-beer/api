<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TypeOfBeerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->artisan('db:seed'); //by stworzyć role

        $this->admin= \App\Models\User::factory()->create();

        $this->admin->assignRole('admin');

        $this->user= \App\Models\User::factory()->create();

        $this->user->assignRole('drinker');

        $this->typeOfBeer = \App\Models\Type::factory()->create([
            'name' => 'Warka'     
        ]);

        $this->typeOfBeer2 = \App\Models\Type::factory()->create([
            'name' => 'Kozeł'     
        ]);
    }

    public function test_admin_can_add_new_type_of_beer()
    {
       $this->withoutExceptionHandling();

        $this->actingAs($this->admin);

        $response = $this->json('POST',"/api/typeOfBeer/add", [
            'name' => 'Tyskie'
        ]);

        $response->assertStatus(200);

        dump($response->getContent());

        $response = $this->assertDatabaseHas('types',['name'=>'Tyskie']);
    }

    public function test_user_can_not_add_new_alc_content()
    {
        //$this->withoutExceptionHandling();

        $this->actingAs($this->user);

        $response = $this->json('POST',"/api/typeOfBeer/add", [
            'name' => 'Tyskie'
        ]);

        $response->assertStatus(403);

        //dump($response->getContent());

        $response = $this->assertDatabaseMissing('types',['name'=>'Tyskie']);
    }

    public function test_unregistered_user_can_not_add_new_type_of_beer()
    {
        //$this->withoutExceptionHandling();


        $response = $this->json('POST',"/api/typeOfBeer/add", [
            'name' => 'Tyskie'
        ]);

        $response->assertStatus(403);

        //dump($response->getContent());

        $response = $this->assertDatabaseMissing('types',['name' => 'Tyskie']);
    }

    public function test_can_not_add_new_type_of_beer_if_value_incorrect()
    {
        //$this->withoutExceptionHandling();

        $this->actingAs($this->admin);

        $response = $this->json('POST',"/api/typeOfBeer/add", [
            'name' => ''
        ]);

        $response->assertStatus(422);

        dump($response->getContent());

        //$response = $this->assertDatabaseMissing('type',['value'=>'sdada']);
    }

    public function test_can_not_add_new_type_of_beer_if_exist()
    {
        //$this->withoutExceptionHandling();

        $this->actingAs($this->admin);

        $typeOfBeer = $this->typeOfBeer;

        $response = $this->json('POST',"/api/typeOfBeer/add", [
            'name' => 'Warka'
        ]);

        $response->assertStatus(422);

        dump($response->getContent());

        $response = $this->assertDatabaseHas('types',['name'=>$this->typeOfBeer['name']]);
    }
    



//EDIT tests

    public function test_admin_can_edit()
    {
        $this->actingAs($this->admin);

        $type=$this->typeOfBeer;

        $response = $this->json('PUT',"/api/typeOfBeer/update/$type->id", [
            'name' => "Żóbr"
        ]);

        $response->assertStatus(200);

        dump($response->getContent());

        $response = $this->assertDatabaseMissing('types',['name'=>$type['name']]);
        $response = $this->assertDatabaseHas('types',['name'=>'Żóbr']);
    }

    public function test_admin_cant_edit_if_value_exist()
    {
        $this->actingAs($this->admin);

        $type=$this->typeOfBeer;

        $response = $this->json('PUT',"/api/typeOfBeer/update/$type->id", [
            'name' => 'Kozeł'
        ]);

        $response->assertStatus(422);

        dump($response->getContent());

    }

    public function test_admin_cant_edit_if_value_incorrect()
    {
        $this->actingAs($this->admin);

        $type=$this->typeOfBeer;

        $response = $this->json('PUT',"/api/typeOfBeer/update/$type->id", [
            'name' => ''
        ]);

        $response->assertStatus(422);

        dump($response->getContent());

    }


    public function test_user_cant_edit()
    {
        $this->actingAs($this->user);
        
        $type=$this->typeOfBeer;

        $response = $this->json('PUT',"/api/typeOfBeer/update/$type->id", [
            'name' => 'Summersby'
        ]);

        $response->assertStatus(403);

        //dump($response->getContent());

    }

    public function test_admin_can_delete_value()
    {
        $this->actingAs($this->admin);
        
        $type=$this->typeOfBeer;

        $response = $this->json('DELETE',"/api/typeOfBeer/delete/$type->id");

        $response->assertStatus(200);

        dump($response->getContent());

        $response = $this->assertDatabaseMissing('types',['name'=>$type['name']]);
    

    }

    

    //DELETE tests
    public function test_user_cant_delete_value()
    {
        $this->actingAs($this->user);
        
        $type=$this->typeOfBeer;

        $response = $this->json('DELETE',"/api/typeOfBeer/delete/$type->id");

        $response->assertStatus(403);

        //dump($response->getContent());

        $response = $this->assertDatabaseHas('types',['name'=>$type['name']]);
    

    }




    public function test_get_all_values()
    {
        $this->withoutExceptionHandling();

        $response = $this->json('GET', "api/typeOfBeer/all");
        $response->assertStatus(200);

        dump($response->getContent());

    }

    public function test_get_one_specific_value()
    {
        $this->withoutExceptionHandling();

        $type=$this->typeOfBeer;

        $response = $this->json('GET', "api/typeOfBeer/$type->id");
        $response->assertStatus(200);

        dump($response->getContent());

    }



}

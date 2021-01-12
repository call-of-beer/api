<?php

namespace Database\Factories;

use App\Models\Beer;
use Illuminate\Database\Eloquent\Factories\Factory;

class BeerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Beer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'alcohol_volume' => $this->faker->randomFloat(1, 0, 10),
            'country_id' => 1,
            'description' => $this->faker->sentence(),
            'user_id' => rand(1,20),
            'type_beer_id'=>1
        ];
    }
}

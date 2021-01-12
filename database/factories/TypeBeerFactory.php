<?php

namespace Database\Factories;

use App\Models\TypeBeer;
use Illuminate\Database\Eloquent\Factories\Factory;

class TypeBeerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TypeBeer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->word
        ];
    }
}

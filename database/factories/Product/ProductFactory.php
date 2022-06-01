<?php

namespace Database\Factories\Product;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name(),
            'description'=>$this->faker->words(3,true),
            'price'=>$this->faker->numberBetween(10, 100),
            'active'=>$this->faker->boolean(),
            'quantity'=>$this->faker->numberBetween(1, 50),
            'category_id'=>$this->faker->numberBetween(1, 10),
        ];
    }
}

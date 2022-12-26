<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(),
            'user_id' => fake()->numberBetween($min =10 , $max = 11),
            'slug' => fake()->sentence(),
            'description' => fake()->text(),
            'short_description' => fake()->text(), 
            'additional_info' => fake()->title(),
            'image' => 'product.jpg',
            'price' => fake()->randomNumber(5),
            'sale_price' => fake()->randomNumber(5),
            
        ];
    }

}

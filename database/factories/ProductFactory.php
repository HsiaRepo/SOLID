<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

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
    public function definition(): array
    {
        return [
            'sku' => fake()->randomElement(['BP063-0001','BP063-0002','BP063-0003','UA064-0002']),
            'name' => fake()->randomElement(['Giorgio','Firetrap','Kangol','Ben Sherman']),
            'price' => fake()->randomElement(['120.25','140.35','156.99'])
        ];
    }
}

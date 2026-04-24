<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
            'name' => fake()->name(),
            'description' => fake()->sentence(7),
            'descriptionLong' => fake()->text(),
            'price' => fake()->randomFloat(2, 7, 777),
            'category_id' => Category::query()->inRandomOrder()->value('id'),
        ];
    }
}
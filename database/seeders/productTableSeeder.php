<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class productTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::query()->firstOrCreate([
            'name' => 'Consolas',
        ], [
            'description' => 'Video game consoles and related hardware.',
        ]);

        Product::create([
            'name' => 'Xbox Series X',
            'description' => 'La consola de videojuegos más potente de Microsoft',
            'descriptionLong' => 'La Xbox Series X es la consola de videojuegos más potente de Microsoft, diseñada para ofrecer una experiencia de juego de última generación.',
            'price' => 499.99,
            'category_id' => $category->id,
        ]);
    }
}

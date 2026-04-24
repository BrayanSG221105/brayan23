<?php

use App\Models\Category;
use App\Models\Product;

it('creates a product with the api', function () {
    $category = Category::factory()->create();

    $payload = [
        'name' => 'Laptop Pro 15',
        'description' => 'Laptop de alto rendimiento',
        'descriptionLong' => 'Laptop para trabajo profesional y edicion de video.',
        'price' => 1299.99,
        'category_id' => $category->id,
    ];

    $response = $this->postJson('/api/products', $payload);

    $response
        ->assertCreated()
        ->assertJsonPath('data.name', 'Laptop Pro 15')
        ->assertJsonPath('data.category.id', $category->id);

    $this->assertDatabaseHas('products', [
        'name' => 'Laptop Pro 15',
        'category_id' => $category->id,
    ]);
});

it('lists products with the api', function () {
    $category = Category::factory()->create();
    Product::factory()->count(2)->create([
        'category_id' => $category->id,
    ]);

    $response = $this->getJson('/api/products');

    $response
        ->assertOk()
        ->assertJsonPath('meta.total', 2)
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'price', 'category_id', 'created_at', 'updated_at'],
            ],
            'links',
            'meta',
        ]);
});

it('shows one product by id with the api', function () {
    $category = Category::factory()->create([
        'name' => 'Audio',
    ]);

    $product = Product::factory()->create([
        'name' => 'Audifonos Pro',
        'category_id' => $category->id,
    ]);

    $response = $this->getJson('/api/products/' . $product->id);

    $response
        ->assertOk()
        ->assertJsonPath('data.id', $product->id)
        ->assertJsonPath('data.name', 'Audifonos Pro')
        ->assertJsonPath('data.category.id', $category->id)
        ->assertJsonPath('data.category.name', 'Audio');
});

it('updates a product with the api', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create([
        'name' => 'Mouse Gamer',
        'category_id' => $category->id,
    ]);

    $newCategory = Category::factory()->create();

    $payload = [
        'name' => 'Mouse Gamer RGB',
        'description' => 'Mouse optico para gaming',
        'descriptionLong' => 'Mouse con sensor de alta precision y luces RGB.',
        'price' => 89.50,
        'category_id' => $newCategory->id,
    ];

    $response = $this->putJson('/api/products/' . $product->id, $payload);

    $response
        ->assertOk()
        ->assertJsonPath('data.name', 'Mouse Gamer RGB')
        ->assertJsonPath('data.category.id', $newCategory->id);

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'name' => 'Mouse Gamer RGB',
        'category_id' => $newCategory->id,
    ]);
});

it('deletes a product with the api', function () {
    $product = Product::factory()->create();

    $response = $this->deleteJson('/api/products/' . $product->id);

    $response
        ->assertOk()
        ->assertJsonPath('message', 'Product deleted successfully.');

    $this->assertSoftDeleted('products', [
        'id' => $product->id,
    ]);
});

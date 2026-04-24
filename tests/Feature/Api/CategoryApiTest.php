<?php

use App\Models\Category;

it('creates a category with the api', function () {
    $payload = [
        'name' => 'Tecnologia',
        'description' => 'Productos tecnologicos',
    ];

    $response = $this->postJson('/api/categories', $payload);

    $response
        ->assertCreated()
        ->assertJsonPath('data.name', 'Tecnologia');

    $this->assertDatabaseHas('categories', [
        'name' => 'Tecnologia',
    ]);
});

it('lists categories with the api', function () {
    Category::factory()->count(3)->create();

    $response = $this->getJson('/api/categories');

    $response
        ->assertOk()
        ->assertJsonPath('meta.total', 3)
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'description', 'created_at', 'updated_at'],
            ],
            'links',
            'meta',
        ]);
});

it('shows one category by id with the api', function () {
    $category = Category::factory()->create([
        'name' => 'Hogar',
    ]);

    $response = $this->getJson('/api/categories/' . $category->id);

    $response
        ->assertOk()
        ->assertJsonPath('data.id', $category->id)
        ->assertJsonPath('data.name', 'Hogar');
});

it('updates a category with the api', function () {
    $category = Category::factory()->create([
        'name' => 'Ropa',
    ]);

    $payload = [
        'name' => 'Ropa y Accesorios',
        'description' => 'Todo para vestir',
    ];

    $response = $this->putJson('/api/categories/' . $category->id, $payload);

    $response
        ->assertOk()
        ->assertJsonPath('data.name', 'Ropa y Accesorios');

    $this->assertDatabaseHas('categories', [
        'id' => $category->id,
        'name' => 'Ropa y Accesorios',
    ]);
});

it('deletes a category with the api', function () {
    $category = Category::factory()->create();

    $response = $this->deleteJson('/api/categories/' . $category->id);

    $response
        ->assertOk()
        ->assertJsonPath('message', 'Category deleted successfully.');

    $this->assertSoftDeleted('categories', [
        'id' => $category->id,
    ]);
});

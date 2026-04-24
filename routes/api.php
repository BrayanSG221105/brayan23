<?php

use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\ContinentApiController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoryApiController::class)
    ->names('api.categories');

Route::apiResource('products', ProductApiController::class)
    ->names('api.products');

Route::get('continentes', [ContinentApiController::class, 'continentesIndex'])->name('api.continentes.index');
Route::get('continentes/{id}', [ContinentApiController::class, 'continentesShow'])->name('api.continentes.show');

Route::get('mundoiti', [ContinentApiController::class, 'mundoitiIndex'])->name('api.mundoiti.index');
Route::get('mundoiti/{id}', [ContinentApiController::class, 'mundoitiShow'])->name('api.mundoiti.show');

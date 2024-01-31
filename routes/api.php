<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'locations'], function() {
    Route::get('/locations', [\App\Http\Controllers\LocationsController::class, 'index']);
    Route::get('/locations/{id}', [\App\Http\Controllers\LocationsController::class, 'show']);
    Route::post('/locations/store', [\App\Http\Controllers\LocationsController::class, 'store']);
    Route::patch('/locations/update', [\App\Http\Controllers\LocationsController::class, 'update']);
});

Route::group(['namespace' => 'abilities'], function() {
    Route::get('/abilities', [\App\Http\Controllers\AbilitiesController::class, 'index']);
    Route::get('/abilities/{id}', [\App\Http\Controllers\AbilitiesController::class, 'show']);
    Route::post('/abilities/store', [\App\Http\Controllers\AbilitiesController::class, 'store']);
    Route::patch('/abilities/update', [\App\Http\Controllers\AbilitiesController::class, 'update']);
});

Route::group(['namespace' => 'pokemons'], function() {
    Route::get('/pokemons', [\App\Http\Controllers\PokemonsController::class, 'index']);
    Route::get('/pokemons/{id}', [\App\Http\Controllers\PokemonsController::class, 'show']);
    Route::post('/pokemons/store', [\App\Http\Controllers\PokemonsController::class, 'store']);
    Route::patch('/pokemons/update', [\App\Http\Controllers\PokemonsController::class, 'update']);
    Route::post('/pokemons/filter', [\App\Http\Controllers\PokemonsController::class, 'sort_filter']);
});

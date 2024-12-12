<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\HabilidadController;
use App\Http\Controllers\UsuarioController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/pokemons',[PokemonController::class, 'index']);
Route::get('/pokemons/{id}',[PokemonController::class, 'show']);
Route::post('/pokemons',[PokemonController::class, 'store']);
Route::put('/pokemons/{id}',[PokemonController::class, 'update']);
Route::delete('/pokemons/{id}',[PokemonController::class, 'destroy']);

Route::get('/pokemons/buscar/{nombre}',[PokemonController::class, 'buscar']);

Route::get('/habilidades',[HabilidadController::class, 'index']);
Route::get('/habilidades/{id}',[HabilidadController::class, 'show']);
Route::post('/habilidades',[HabilidadController::class, 'store']);
Route::put('/habilidades/{id}',[HabilidadController::class, 'update']);
Route::delete('/habilidades/{id}',[HabilidadController::class, 'destroy']);

Route::get('/usuarios/hay', [UsuarioController::class, 'cuantosHay']);
Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
Route::post('/usuarios', [UsuarioController::class, 'store']);
Route::put('/usuarios/{id}',  [UsuarioController::class, 'update']);
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);
Route::patch('/usuarios/{id}', [UsuarioController::class, 'updateParcial']);


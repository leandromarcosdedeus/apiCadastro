<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\ClientController;
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

//lista de todos clients
Route::get('clients', [ClientController::class, 'getClients']);

//cliente específico
Route::get('client/{id}', [ClientController::class, 'getClientsById']);

//adicionando cliente
Route::post('addClient', [ClientController::class, 'addClient']);

//update client
Route::put('updateClient/{id}', [ClientController::class, 'updateClient']);

//delete client
Route::delete('deleteClient/{id}', [ClientController::class, 'deleteClient']);

//item frequente
Route::get('/bigCity', [CityController::class, 'bigCity']);

Route::get('/biggestCrown', [ClientController::class, 'biggestCrown']);

//Rotas tabela Cidades
Route::post('/addCity', [CityController::class, 'addCity']);

Route::put('updateCity/{id}', [CityController::class, 'updateCity']);

Route::get('city', [CityController::class, 'getCity']);

Route::delete('deleteCity/{id}', [CityController::class, 'deleteCity']);

Route::get('city/{id}', [CityController::class, 'getCityById']);

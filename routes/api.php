<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartementsController;
use App\Http\Controllers\CommunesController;
use App\Http\Controllers\ArrondissementsController;
use App\Http\Controllers\QuartiersController;
use App\Http\Controllers\CitizensController;

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

/*
|--------------------------------------------------------------------------
| Routes des Départements
|--------------------------------------------------------------------------
*/
Route::prefix('departements')->group(function () {
    Route::get('/', [DepartementsController::class, 'index']);
    Route::post('/', [DepartementsController::class, 'store']);
    Route::get('/{id}', [DepartementsController::class, 'show']);
    Route::put('/{id}', [DepartementsController::class, 'update']);
    Route::delete('/{id}', [DepartementsController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Routes des Communes
|--------------------------------------------------------------------------
*/
Route::prefix('communes')->group(function () {
    Route::get('/', [CommunesController::class, 'index']);
    Route::post('/', [CommunesController::class, 'store']);
    Route::get('/departement/{departementId}', [CommunesController::class, 'getByDepartement']);
    Route::get('/{id}', [CommunesController::class, 'show']);
    Route::put('/{id}', [CommunesController::class, 'update']);
    Route::delete('/{id}', [CommunesController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Routes des Arrondissements
|--------------------------------------------------------------------------
*/
Route::prefix('arrondissements')->group(function () {
    Route::get('/', [ArrondissementsController::class, 'index']);
    Route::post('/', [ArrondissementsController::class, 'store']);
    Route::get('/commune/{communeId}', [ArrondissementsController::class, 'getByCommune']);
    Route::get('/{id}', [ArrondissementsController::class, 'show']);
    Route::put('/{id}', [ArrondissementsController::class, 'update']);
    Route::delete('/{id}', [ArrondissementsController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Routes des Quartiers
|--------------------------------------------------------------------------
*/
Route::prefix('quartiers')->group(function () {
    Route::get('/', [QuartiersController::class, 'index']);
    Route::post('/', [QuartiersController::class, 'store']);
    Route::get('/arrondissement/{arrondissementId}', [QuartiersController::class, 'getByArrondissement']);
    Route::get('/{id}', [QuartiersController::class, 'show']);
    Route::put('/{id}', [QuartiersController::class, 'update']);
    Route::delete('/{id}', [QuartiersController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Routes des Citoyens
|--------------------------------------------------------------------------
*/
Route::prefix('citizens')->group(function () {
    Route::get('/', [CitizensController::class, 'index']);
    Route::post('/', [CitizensController::class, 'store']);
    Route::get('/search', [CitizensController::class, 'search']);
    Route::get('/expired', [CitizensController::class, 'getExpired']);
    Route::get('/statistics', [CitizensController::class, 'statistics']);
    Route::get('/{id}', [CitizensController::class, 'show']);
    Route::post('/{id}', [CitizensController::class, 'update']); // POST pour supporter l'upload de fichiers
    Route::delete('/{id}', [CitizensController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Routes alternatives avec apiResource (optionnel)
|--------------------------------------------------------------------------
| Vous pouvez également utiliser apiResource au lieu de définir 
| manuellement chaque route CRUD. Décommentez si vous préférez :
|
| Route::apiResource('departements', DepartementsController::class);
| Route::apiResource('communes', CommuneController::class);
| Route::apiResource('arrondissements', ArrondissementController::class);
| Route::apiResource('quartiers', QuartierController::class);
| Route::apiResource('citizens', CitizenController::class);
|
*/
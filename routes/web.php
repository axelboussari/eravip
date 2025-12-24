<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartementsController;
use App\Http\Controllers\CommunesController;
use App\Http\Controllers\CitizensController;


Route::resource('departements', DepartementsController::class);

// Routes pour les communes
Route::resource('communes', CommunesController::class);

// Route API pour récupérer les communes par département
Route::get('api/communes/departement/{departement_id}', [CommunesController::class, 'getByDepartement'])
    ->name('api.communes.by.departement');

// Routes pour les citoyens
Route::resource('citizens', CitizensController::class);

// Routes API pour le formulaire en cascade
Route::get('api/arrondissements/commune/{commune_id}', [CitizensController::class, 'getArrondissementsByCommune'])
    ->name('api.arrondissements.by.commune');

Route::get('api/quartiers/arrondissement/{arrondissement_id}', [CitizensController::class, 'getQuartiersByArrondissement'])
    ->name('api.quartiers.by.arrondissement');
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('index');
});

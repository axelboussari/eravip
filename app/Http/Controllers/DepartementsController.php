<?php

namespace App\Http\Controllers;

use App\Models\departements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartementsController extends Controller
{
    /**
     * Afficher la liste des départements
     */
    public function index()
    {
        $departements = departements::with('communes')->get();
        return response()->json($departements);
    }

    /**
     * Créer un nouveau département
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom_departement' => 'required|string|max:255|unique:departements',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $departement = departements::create($request->all());
        return response()->json(['message' => 'Département créé avec succès', 'data' => $departement], 201);
    }

    /**
     * Afficher un département spécifique
     */
    public function show($id)
    {
        $departement = departements::with('communes.arrondissements')->findOrFail($id);
        return response()->json($departement);
    }

    /**
     * Mettre à jour un département
     */
    public function update(Request $request, $id)
    {
        $departement = departements::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nom_departement' => 'required|string|max:255|unique:departements,nom_departement,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $departement->update($request->all());
        return response()->json(['message' => 'Département mis à jour avec succès', 'data' => $departement]);
    }

    /**
     * Supprimer un département
     */
    public function destroy($id)
    {
        $departement = departements::findOrFail($id);
        $departement->delete();
        return response()->json(['message' => 'Département supprimé avec succès'], 200);
    }
}
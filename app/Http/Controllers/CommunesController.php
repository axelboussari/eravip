<?php

namespace App\Http\Controllers;

use App\Models\communes;
use App\Models\departements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommunesController extends Controller
{
    /**
     * Afficher la liste de toutes les communes
     */
    public function index()
    {
        $communes = communes::with('departement')->paginate(15);
        return response()->json([
            'success' => true,
            'data' => $communes
        ]);
    }

    /**
     * Afficher le formulaire de création d'une nouvelle commune
     */
    public function create()
    {
        $departements = departements::all();
        return response()->json([
            'success' => true,
            'departements' => $departements
        ]);
    }

    /**
     * Enregistrer une nouvelle commune
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom_commune' => 'required|string|max:255|unique:communes,nom_commune',
            'departement_id' => 'required|uuid|exists:departements,id'
        ], [
            'nom_commune.required' => 'Le nom de la commune est obligatoire',
            'nom_commune.unique' => 'Cette commune existe déjà',
            'departement_id.required' => 'Le département est obligatoire',
            'departement_id.exists' => 'Le département sélectionné n\'existe pas'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $commune = communes::create([
            'nom_commune' => $request->nom_commune,
            'departement_id' => $request->departement_id
        ]);


        return response()->json([
            'success' => true,
            'message' => 'Commune créée avec succès',
            'data' => $commune->load('departement')
        ], 201);
    }

    /**
     * Afficher une commune spécifique
     */
    public function show($id)
    {
        $commune = communes::with(['departement', 'arrondissements', 'citizens'])->find($id);

        if (!$commune) {
            return response()->json([
                'success' => false,
                'message' => 'Commune non trouvée'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $commune
        ]);
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit($id)
    {
        $commune = communes::with('departement')->find($id);

        if (!$commune) {
            return response()->json([
                'success' => false,
                'message' => 'Commune non trouvée'
            ], 404);
        }

        $departements = departements::all();

        return response()->json([
            'success' => true,
            'data' => $commune,
            'departements' => $departements
        ]);
    }

    /**
     * Mettre à jour une commune
     */
    public function update(Request $request, $id)
    {
        $commune = communes::find($id);

        if (!$commune) {
            return response()->json([
                'success' => false,
                'message' => 'Commune non trouvée'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nom_commune' => 'required|string|max:255|unique:communes,nom_commune,' . $id,
            'departement_id' => 'required|uuid|exists:departements,id'
        ], [
            'nom_commune.required' => 'Le nom de la commune est obligatoire',
            'nom_commune.unique' => 'Cette commune existe déjà',
            'departement_id.required' => 'Le département est obligatoire',
            'departement_id.exists' => 'Le département sélectionné n\'existe pas'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $commune->update([
            'nom_commune' => $request->nom_commune,
            'departement_id' => $request->departement_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Commune mise à jour avec succès',
            'data' => $commune->load('departement')
        ]);
    }

    /**
     * Supprimer une commune
     */
    public function destroy($id)
    {
        $commune = communes::find($id);

        if (!$commune) {
            return response()->json([
                'success' => false,
                'message' => 'Commune non trouvée'
            ], 404);
        }

        // Vérifier s'il y a des arrondissements ou citoyens liés
        if ($commune->arrondissements()->count() > 0 || $commune->citizens()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Impossible de supprimer cette commune car elle contient des arrondissements ou des citoyens'
            ], 409);
        }

        $commune->delete();

        return response()->json([
            'success' => true,
            'message' => 'Commune supprimée avec succès'
        ]);
    }

    /**
     * Obtenir toutes les communes d'un département spécifique
     */
    public function getByDepartement($departementId)
    {
        $communes = communes::where('departement_id', $departementId)
            ->with('departement')
            ->get();
        \Log::info('Commune créée:', ['commune' => $communes]);


        return response()->json([
            'success' => true,
            'data' => $communes
        ]);
    }

    /**
     * Rechercher des communes par nom
     */
    public function search(Request $request)
    {
        $search = $request->input('q');

        $communes = communes::where('nom_commune', 'LIKE', "%{$search}%")
            ->with('departement')
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $communes
        ]);
    }
}
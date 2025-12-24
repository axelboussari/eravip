<?php

namespace App\Http\Controllers;

use App\Models\quartiers;
use App\Models\arrondissements;
use App\Models\communes;
use App\Models\departements;
use Illuminate\Http\Request;

class QuartiersController extends Controller
{
    /**
     * Afficher la liste de tous les quartiers
     */
    public function index()
    {
        $quartiers = quartiers::with(['arrondissement.commune.departement'])->get();
        return view('quartiers.index', compact('quartiers'));
    }

    /**
     * Afficher le formulaire de création d'un quartier
     */
    public function create()
    {
        $departements = departements::all();
        $communes = communes::all();
        $arrondissements = arrondissements::all();
        return view('quartiers.create', compact('departements', 'communes', 'arrondissements'));
    }

    /**
     * Enregistrer un nouveau quartier
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_quartier' => 'required|string|max:255',
            'arrondissement_id' => 'required|exists:arrondissements,id',
        ]);

        quartiers::create($validated);

        return redirect()->route('quartiers.index')->with('success', 'Quartier créé avec succès.');
    }

    /**
     * Afficher les détails d'un quartier
     */
    public function show($id)
    {
        $quartier = quartiers::with(['arrondissement.commune.departement', 'citizens'])->findOrFail($id);
        return view('quartiers.show', compact('quartier'));
    }

    /**
     * Afficher le formulaire d'édition d'un quartier
     */
    public function edit($id)
    {
        $quartier = quartiers::findOrFail($id);
        $departements = departements::all();
        $communes = communes::all();
        $arrondissements = arrondissements::all();
        return view('quartiers.edit', compact('quartier', 'departements', 'communes', 'arrondissements'));
    }

    /**
     * Mettre à jour un quartier
     */
    public function update(Request $request, $id)
    {
        $quartier = quartiers::findOrFail($id);

        $validated = $request->validate([
            'nom_quartier' => 'required|string|max:255',
            'arrondissement_id' => 'required|exists:arrondissements,id',
        ]);

        $quartier->update($validated);

        return redirect()->route('quartiers.index')->with('success', 'Quartier mis à jour avec succès.');
    }

    /**
     * Supprimer un quartier
     */
    public function destroy($id)
    {
        $quartier = quartiers::findOrFail($id);
        
        // Vérifier s'il y a des citoyens associés
        $hasCitizens = $quartier->citizens()->count() > 0;
        
        if ($hasCitizens) {
            return redirect()->route('quartiers.index')
                ->with('error', 'Impossible de supprimer ce quartier car il contient des citoyens.');
        }

        $quartier->delete();

        return redirect()->route('quartiers.index')->with('success', 'Quartier supprimé avec succès.');
    }

    /**
     * API: Récupérer les quartiers d'un arrondissement spécifique
     * Utilisé pour les sélections en cascade via AJAX
     */
    public function getByArrondissement($arrondissement_id)
    {
        $quartiers = quartiers::where('arrondissement_id', $arrondissement_id)
            ->orderBy('nom_quartier', 'asc')
            ->get(['id', 'nom_quartier']);
        
        return response()->json($quartiers);
    }
}
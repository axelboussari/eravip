<?php

namespace App\Http\Controllers;

use App\Models\arrondissements;
use App\Models\communes;
use App\Models\departements;
use App\Models\quartiers;
use Illuminate\Http\Request;

class ArrondissementsController extends Controller
{
    /**
     * Afficher la liste de tous les arrondissements
     */
    public function index()
    {
        $arrondissements = arrondissements::with(['commune.departement'])->get();
        return view('arrondissements.index', compact('arrondissements'));
    }

    /**
     * Afficher le formulaire de création d'un arrondissement
     */
    public function create()
    {
        $departements = departements::all();
        $communes = communes::all();
        return view('arrondissements.create', compact('departements', 'communes'));
    }

    /**
     * Enregistrer un nouvel arrondissement
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_arrondissement' => 'required|string|max:255',
            'commune_id' => 'required|exists:communes,id',
        ]);

        arrondissements::create($validated);

        return redirect()->route('arrondissements.index')->with('success', 'Arrondissement créé avec succès.');
    }

    /**
     * Afficher les détails d'un arrondissement
     */
    public function show($id)
    {
        $arrondissement = arrondissements::with(['commune.departement', 'quartiers', 'citizens'])->findOrFail($id);
        return view('arrondissements.show', compact('arrondissement'));
    }

    /**
     * Afficher le formulaire d'édition d'un arrondissement
     */
    public function edit($id)
    {
        $arrondissement = arrondissements::findOrFail($id);
        $departements = departements::all();
        $communes = communes::all();
        return view('arrondissements.edit', compact('arrondissement', 'departements', 'communes'));
    }

    /**
     * Mettre à jour un arrondissement
     */
    public function update(Request $request, $id)
    {
        $arrondissement = arrondissements::findOrFail($id);

        $validated = $request->validate([
            'nom_arrondissement' => 'required|string|max:255',
            'commune_id' => 'required|exists:communes,id',
        ]);

        $arrondissement->update($validated);

        return redirect()->route('arrondissements.index')->with('success', 'Arrondissement mis à jour avec succès.');
    }

    /**
     * Supprimer un arrondissement
     */
    public function destroy($id)
    {
        $arrondissement = arrondissements::findOrFail($id);
        
        // Vérifier s'il y a des quartiers ou citoyens associés
        $hasQuartiers = $arrondissement->quartiers()->count() > 0;
        $hasCitizens = $arrondissement->citizens()->count() > 0;
        
        if ($hasQuartiers || $hasCitizens) {
            return redirect()->route('arrondissements.index')
                ->with('error', 'Impossible de supprimer cet arrondissement car il contient des quartiers ou des citoyens.');
        }

        $arrondissement->delete();

        return redirect()->route('arrondissements.index')->with('success', 'Arrondissement supprimé avec succès.');
    }

    /**
     * API: Récupérer les arrondissements d'une commune spécifique
     * Utilisé pour les sélections en cascade via AJAX
     */
    public function getByCommune($commune_id)
    {
        $arrondissements = arrondissements::where('commune_id', $commune_id)
            ->orderBy('nom_arrondissement', 'asc')
            ->get(['id', 'nom_arrondissement']);
        
        return response()->json($arrondissements);
    }

    /**
     * API: Récupérer les quartiers d'un arrondissement spécifique
     * Utilisé pour les sélections en cascade via AJAX
     */
    public function getQuartiersByArrondissement($arrondissement_id)
    {
        $quartiers = quartiers::where('arrondissement_id', $arrondissement_id)
            ->orderBy('nom_quartier', 'asc')
            ->get(['id', 'nom_quartier']);
        
        return response()->json($quartiers);
    }
}
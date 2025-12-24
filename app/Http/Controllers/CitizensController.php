<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Upload;
use App\Models\citizens;
use App\Models\communes;
use App\Models\arrondissements;
use App\Models\quartiers;
use App\Models\departements;
use Illuminate\Support\Facades\Storage;

class CitizensController extends Controller
{
    // List all citizens
    public function index()
    {
        $citizens = citizens::with(['commune', 'arrondissement', 'quartier'])->get();
        return view('list', compact('citizens')); // Changed from 'show' to 'citizens.index'
    }

    // Show create form
    public function create()
    {
        $departements = departements::all();
        $communes = communes::all();
        $arrondissements = arrondissements::all();
        $quartiers = quartiers::all();
        return view('create', compact('departements', 'communes', 'arrondissements', 'quartiers'));
    }

    // Store new citizen
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string|max:255',
            'nationalite' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|email|unique:citizens',
            'phone' => 'nullable|string|max:20',
            'adresse' => 'required|string|max:500',
            'date_dexpire' => 'required|date',
            'filiation' => 'required|array',
            'filiation.parent1' => 'required|string|max:255',
            'filiation.parent2' => 'nullable|string|max:255',
            'commune_id' => 'required|exists:communes,id',
            'arrondissement_id' => 'required|exists:arrondissements,id',
            'quartier_id' => 'required|exists:quartiers,id',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('citizens/photos', 'public');
            $validated['photo'] = $path;
        }

        $validated['filiation'] = json_encode($validated['filiation']);

        citizens::create($validated);

        return redirect()->route('citizens.index')->with('success', 'Citoyen créé avec succès.');
    }

    // Show single citizen details
    public function show($id)
    {
        $citizen = citizens::with(['commune', 'arrondissement', 'quartier'])->findOrFail($id);
        return view('show', compact('citizen'));
    }

    // Show edit form
    public function edit($id)
    {
        $citizen = citizens::findOrFail($id);
        $departements = departements::all();
        $communes = communes::all();
        $arrondissements = arrondissements::all();
        $quartiers = quartiers::all();
        return view('edit', compact('citizen', 'departements', 'communes', 'arrondissements', 'quartiers'));
    }

    // Update citizen
    public function update(Request $request, $id)
    {
        $citizen = citizens::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string|max:255',
            'nationalite' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|unique:citizens,email,' . $citizen->id, // Fixed validation syntax
            'phone' => 'required|string|unique:citizens,phone,' . $citizen->id, // Fixed validation syntax
            'adresse' => 'required|string|max:500',
            'date_dexpire' => 'required|date',
            'filiation' => 'required|array',
            'filiation.parent1' => 'required|string|max:255',
            'filiation.parent2' => 'nullable|string|max:255',
            'commune_id' => 'required|exists:communes,id',
            'arrondissement_id' => 'required|exists:arrondissements,id',
            'quartier_id' => 'required|exists:quartiers,id',
        ]);

        if ($request->hasFile('photo')) {
            if ($citizen->photo) {
                Storage::disk('public')->delete($citizen->photo);
            }
            $path = $request->file('photo')->store('citizens/photos', 'public');
            $validated['photo'] = $path;
        }

        if (isset($validated['filiation'])) {
            $validated['filiation'] = json_encode($validated['filiation']);
        }

        $citizen->update($validated);

        return redirect()->route('citizens.index')->with('success', 'Citoyen mis à jour avec succès.');
    }

    // Delete citizen
    public function destroy($id)
    {
        $citizen = citizens::findOrFail($id);
        if ($citizen->photo) {
            Storage::disk('public')->delete($citizen->photo);
        }
        $citizen->delete();

        return redirect()->route('citizens.index')->with('success', 'Citoyen supprimé avec succès.');
    }

    // AJAX: Get arrondissements by commune
    public function getArrondissementsByCommune($commune_id)
    {
        $arrondissements = arrondissements::where('commune_id', $commune_id)->get();
        return response()->json($arrondissements);
    }

    // AJAX: Get quartiers by arrondissement
    public function getQuartiersByArrondissement($arrondissement_id)
    {
        $quartiers = quartiers::where('arrondissement_id', $arrondissement_id)->get();
        return response()->json($quartiers);
    }
}
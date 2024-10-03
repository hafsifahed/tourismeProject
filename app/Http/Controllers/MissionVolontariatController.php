<?php

namespace App\Http\Controllers;

use App\Models\MissionVolontariat;
use Illuminate\Http\Request;

class MissionVolontariatController extends Controller
{
    // Afficher les missions pour l'admin
    public function indexAdmin()
    {
        $missions = MissionVolontariat::all();
        return view('pages.missions.index-admin', compact('missions'));
    }

    // Afficher les missions pour l'utilisateur
    public function indexUser()
    {
        $missions = MissionVolontariat::all();
        return view('pages.missions.index-user', compact('missions'));
    }

    // Formulaire de création
    public function create()
    {
        return view('pages.missions.create');
    }

    // Enregistrer une nouvelle mission
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'lieu' => 'required',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'nom_association' => 'required',
            'description_association' => 'required',
        ]);

        MissionVolontariat::create($validated);

        return redirect()->route('missions.indexAdmin')->with('success', 'Mission ajoutée avec succès');
    }

    // Formulaire de modification
    public function edit(MissionVolontariat $mission)
    {
        return view('pages.missions.edit', compact('mission'));
    }

    // Mettre à jour une mission
    public function update(Request $request, MissionVolontariat $mission)
    {
        $validated = $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'lieu' => 'required',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'nom_association' => 'required',
            'description_association' => 'required',
        ]);

        $mission->update($validated);

        return redirect()->route('missions.indexAdmin')->with('success', 'Mission modifiée avec succès');
    }

    // Supprimer une mission
    public function destroy(MissionVolontariat $mission)
    {
        $mission->delete();
        return redirect()->route('missions.indexAdmin')->with('success', 'Mission supprimée avec succès');
    }
}

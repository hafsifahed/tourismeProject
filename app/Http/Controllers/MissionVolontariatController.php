<?php

namespace App\Http\Controllers;

use App\Models\MissionVolontariat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validation de l'image
        ]);

        // Sauvegarder l'image si elle est fournie
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/missions', 'public'); // Stocker l'image dans le dossier public
            $validated['image'] = $path; // Ajouter le chemin de l'image aux données validées
        }

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
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validation de l'image
        ]);

        // Sauvegarder l'image si elle est fournie
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($mission->image) {
                Storage::disk('public')->delete($mission->image);
            }

            $path = $request->file('image')->store('images/missions', 'public'); // Stocker l'image
            $validated['image'] = $path; // Ajouter le chemin de l'image aux données validées
        }

        $mission->update($validated);

        return redirect()->route('missions.indexAdmin')->with('success', 'Mission modifiée avec succès');
    }

    // Supprimer une mission
    public function destroy(MissionVolontariat $mission)
    {
        // Supprimer l'image si elle existe
        if ($mission->image) {
            Storage::disk('public')->delete($mission->image);
        }

        $mission->delete();
        return redirect()->route('missions.indexAdmin')->with('success', 'Mission supprimée avec succès');
    }
}

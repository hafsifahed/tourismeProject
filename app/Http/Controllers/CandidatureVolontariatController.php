<?php

namespace App\Http\Controllers;

use App\Models\CandidatureVolontariat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\MissionVolontariat;

use Illuminate\Support\Facades\Auth;

class CandidatureVolontariatController extends Controller
{
    // Afficher toutes les candidatures (pour l'admin)
    public function indexAdmin()
{
    // Récupérer uniquement les candidatures en attente
    $candidatures = CandidatureVolontariat::where('etat', 'en attente')->get();
    return view('pages.candidatures.index-admin', compact('candidatures'));
}


public function create($mission_id)
{
    // Vérifiez si la mission existe
    $mission = MissionVolontariat::find($mission_id);

    // Si la mission n'existe pas, redirigez vers une page d'erreur ou vers la liste des missions
    if (!$mission) {
        return redirect()->route('missions.indexUser')->with('error', 'Mission non trouvée');
    }

    // Passez l'ID de la mission à la vue
    return view('pages.candidatures.create', compact('mission_id'));
}

 // Enregistrer une nouvelle candidature avec fichier CV
public function store(Request $request)
{
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'motivation' => 'required|string',
        'cv' => 'required|file|mimes:pdf|max:2048',
    ]);

    // Handle file upload
    if ($request->hasFile('cv')) {
        // Store the uploaded file in the 'public/cvs' directory
        $cvPath = $request->file('cv')->store('cvs', 'public');
    }

    // Create new Candidature with the CV file path and default values
    CandidatureVolontariat::create([
        'user_id' => Auth::id(), // Associer la candidature à l'utilisateur avec ID 1
        'mission_id' => $request->mission_id, // Associer la candidature à la mission avec ID 1
        'nom' => $validated['nom'],
        'email' => $validated['email'],
        'motivation' => $validated['motivation'],
        'cv' => $cvPath, // Store the file path in the 'cv' column
        'etat' => 'en attente', // Set default state
    ]);

    return redirect()->route('missions.indexUser')->with('success', 'Candidature soumise avec succès');
}


    // Afficher le formulaire de modification pour une candidature
    public function edit(CandidatureVolontariat $candidature)
    {
        return view('pages.candidatures.edit', compact('candidature'));
    }

    // Mettre à jour une candidature avec nouveau fichier CV (optionnel)
    public function update(Request $request, CandidatureVolontariat $candidature)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'motivation' => 'required|string',
            'cv' => 'nullable|file|mimes:pdf|max:2048', // CV is optional on update
        ]);

        // Handle file upload if a new CV is provided
        if ($request->hasFile('cv')) {
            // Delete the old CV file if it exists
            if ($candidature->cv) {
                Storage::disk('public')->delete($candidature->cv);
            }

            // Store the new uploaded file
            $cvPath = $request->file('cv')->store('cvs', 'public');
            $validated['cv'] = $cvPath;
        }

        // Update the candidature with the new data
        $candidature->update($validated);

        return redirect()->route('candidatures.indexAdmin')->with('success', 'Candidature modifiée avec succès');
    }

    // Supprimer une candidature et son fichier CV
    public function destroy(CandidatureVolontariat $candidature)
    {
        // Delete the associated CV file if it exists
        if ($candidature->cv) {
            Storage::disk('public')->delete($candidature->cv);
        }

        // Delete the candidature record
        $candidature->delete();

        return redirect()->route('candidatures.indexAdmin')->with('success', 'Candidature supprimée avec succès');
    }

    // Afficher les détails d'une candidature
    public function show(CandidatureVolontariat $candidature)
    {
        return view('pages.candidatures.show', compact('candidature'));
    }

    // Accepter une candidature
    public function accepter($id)
    {
        $candidature = CandidatureVolontariat::findOrFail($id);
        $candidature->etat = 'acceptée'; // Mettre à jour l'état
        $candidature->save();

        return redirect()->route('candidatures.indexAdmin')->with('success', 'Candidature acceptée avec succès.');
    }

    // Refuser une candidature
    public function refuser($id)
    {
        $candidature = CandidatureVolontariat::findOrFail($id);
        $candidature->etat = 'refusée'; // Mettre à jour l'état
        $candidature->save();

        return redirect()->route('candidatures.indexAdmin')->with('success', 'Candidature refusée avec succès.');
    }
}
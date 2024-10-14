<?php

namespace App\Http\Controllers;

use App\Models\CandidatureVolontariat;
use Illuminate\Http\Request;

class CandidatureVolontariatController extends Controller
{
    // Afficher toutes les candidatures (pour l'admin)
    public function indexAdmin()
    {
        $candidatures = CandidatureVolontariat::all();
        return view('pages.candidatures.index-admin', compact('candidatures'));
    }

    // Afficher le formulaire de candidature (pour l'utilisateur)
    public function create()
    {
        return view('pages.candidatures.create');
    }

    // Enregistrer une nouvelle candidature
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'motivation' => 'required|string',
        ]);

        CandidatureVolontariat::create($validated);

        return redirect()->route('missions.indexUser')->with('success', 'Candidature soumise avec succès');
    }

    // Afficher le formulaire de modification pour une candidature
    public function edit(CandidatureVolontariat $candidature)
    {
        return view('pages.candidatures.edit', compact('candidature'));
    }

    // Mettre à jour une candidature
    public function update(Request $request, CandidatureVolontariat $candidature)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'motivation' => 'required|string',
        ]);

        $candidature->update($validated);

        return redirect()->route('candidatures.indexAdmin')->with('success', 'Candidature modifiée avec succès');
    }

    // Supprimer une candidature
    public function destroy(CandidatureVolontariat $candidature)
    {
        $candidature->delete();
        return redirect()->route('candidatures.indexAdmin')->with('success', 'Candidature supprimée avec succès');
    }


    // Afficher les détails d'une candidature
    public function show(CandidatureVolontariat $candidature)
    {
        return view('pages.candidatures.show', compact('candidature'));
    }



}

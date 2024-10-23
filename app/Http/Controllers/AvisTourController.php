<?php

namespace App\Http\Controllers;

use App\Models\AvisTour;
use Illuminate\Http\Request;
use App\Models\GuideLocal;
use App\Models\User;

class AvisTourController extends Controller
{
    // Retrieve all reviews
    public function index()
    {
        $avis = AvisTour::with(['guideLocal', 'user'])->get(); // Eager load relations
        return view('pages.avis.avis-list', compact('avis'));
    }

    // Show the form for creating a new review
    public function create()
    {
        $guides = GuideLocal::all();
        $utilisateurs = User::all();
        return view('pages.avis.avis-create', compact('guides', 'utilisateurs'));
    }

    // Store a new review
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'guide_local' => 'required|exists:guides_locaux,id',
            'utilisateur' => 'required|exists:users,id',
            'note' => 'required|integer|min:1|max:10', // Changed to integer for ratings
            'commentaire' => 'required|string|max:1000', // Optional max length for comments
        ]);

        AvisTour::create($validatedData);
        return to_route('avistour.list')->with('success', "Avis de tour créé avec succès");
    }

    // Show the form for editing a specific review
    public function edit($id)
    {
        $avis = AvisTour::findOrFail($id);
        $guides = GuideLocal::all();
        $utilisateurs = User::all(); // Changed to plural for consistency
        return view('pages.avis.avis-edit', compact('guides', 'utilisateurs', 'avis'));
    }

    // Retrieve a specific review by ID
    public function show($id)
    {
        $avis = AvisTour::findOrFail($id);
        return response()->json($avis);
    }

    // Update a review
    public function update(Request $request, $id)
    {
        $avis = AvisTour::findOrFail($id);

        // Validate the incoming data
        $validatedData = $request->validate([
            'guide_local' => 'required|exists:guides_locaux,id',
            'utilisateur' => 'required|exists:users,id',
            'note' => 'required|integer|min:1|max:10',
            'commentaire' => 'required|string|max:1000',
        ]);

        $avis->update($validatedData); // Update with validated data
        return to_route('avistour.list')->with('success', "Avis de tour mis à jour avec succès");
    }

    // Delete a review
    public function destroy($id)
    {
        $avis = AvisTour::findOrFail($id);
        $avis->delete();
        return to_route('avistour.list')->with('success', "Avis de tour supprimé avec succès");
    }
}

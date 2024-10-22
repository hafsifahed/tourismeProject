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
        $avis = AvisTour::all();
        return view('pages.avis.avis-list', compact('avis'));
    }

    // Create a new review
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'guide_local' => 'required|exists:guides_locaux,id',
            'utilisateur' => 'required|exists:users,id',
            'note' => 'required|string|max:10',
            'commentaire' => 'required|string',
        ]);

        //$avis = 
        AvisTour::create($validatedData);
        //return response()->json($avis, 201);
        return to_route('avistour.list')->with('success', "Avis de tour cree avec succes");
    }

    public function create() {
        $guides = GuideLocal::all();
        $utilisateurs = User::all();
        return view('pages.avis.avis-create', compact('guides', 'utilisateurs'));
    }

    public function edit($id) {
        $avis = AvisTour::findOrFail($id);
        $guides = GuideLocal::all();
        $utilisateur = User::all();
        return view('pages.avis.avis-edit', compact('guides', 'utilisateur', 'avis'));
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
        $avis->update($request->all());
        return to_route('avistour.list')->with('success', "Avis de tour mise a jour avec succes");
    }

    // Delete a review
    public function destroy($id)
    {
        $avis = AvisTour::findOrFail($id);
        $avis->delete();
        return to_route('avistour.list')->with('success', "Avis de tour supprimee avec succes");
    }
}

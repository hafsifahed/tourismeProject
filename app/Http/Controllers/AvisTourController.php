<?php

namespace App\Http\Controllers;

use App\Models\AvisTour;
use Illuminate\Http\Request;

class AvisTourController extends Controller
{
    // Retrieve all reviews
    public function index()
    {
        return AvisTour::all();
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

        $avis = AvisTour::create($validatedData);
        return response()->json($avis, 201);
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
        return response()->json($avis, 200);
    }

    // Delete a review
    public function destroy($id)
    {
        $avis = AvisTour::findOrFail($id);
        $avis->delete();
        return response()->json(null, 204);
    }
}

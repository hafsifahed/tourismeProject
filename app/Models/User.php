<?php

namespace App\Http\Controllers;

use App\Models\GuideLocal;
use Illuminate\Http\Request;

class GuideLocalController extends Controller
{
    // Retrieve all guides
    public function index()
    {
        return GuideLocal::all();
    }

    // Create a new guide
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'type_tour' => 'required|exists:types_tours,id',
            'description' => 'nullable|string',
            'region' => 'nullable|string',
            'ville' => 'nullable|string',
            'disponibilites' => 'nullable|string',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'site_web' => 'nullable|url',
            'certification' => 'boolean',
            'tour_groupe' => 'boolean',
            'tour_prive' => 'boolean',
            'photo_url' => 'nullable|string',
        ]);

        $guide = GuideLocal::create($validatedData);
        return response()->json($guide, 201);
    }

    // Retrieve a specific guide by ID
    public function show($id)
    {
        $guide = GuideLocal::findOrFail($id);
        return response()->json($guide);
    }

    // Update a guide
    public function update(Request $request, $id)
    {
        $guide = GuideLocal::findOrFail($id);
        $guide->update($request->all());
        return response()->json($guide, 200);
    }

    // Delete a guide
    public function destroy($id)
    {
        $guide = GuideLocal::findOrFail($id);
        $guide->delete();
        return response()->json(null, 204);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\TypeTour;
use Illuminate\Http\Request;

class TypeTourController extends Controller
{
    // Retrieve all types of tours
    public function index()
    {
        return TypeTour::all();
    }

    // Create a new type of tour
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_tour' => 'required|string|max:255',
        ]);

        $typeTour = TypeTour::create($validatedData);
        return response()->json($typeTour, 201);
    }

    // Retrieve a specific type of tour by ID
    public function show($id)
    {
        $typeTour = TypeTour::findOrFail($id);
        return response()->json($typeTour);
    }

    // Update a type of tour
    public function update(Request $request, $id)
    {
        $typeTour = TypeTour::findOrFail($id);
        $typeTour->update($request->all());
        return response()->json($typeTour, 200);
    }

    // Delete a type of tour
    public function destroy($id)
    {
        $typeTour = TypeTour::findOrFail($id);
        $typeTour->delete();
        return response()->json(null, 204);
    }
}

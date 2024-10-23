<?php

namespace App\Http\Controllers;

use App\Models\TypeTour;
use Illuminate\Http\Request;

class TypeTourController extends Controller
{
    // Retrieve all types of tours
    public function index()
    {
        $types = TypeTour::all();
        return view('pages.types.types-list', compact('types'));
    }

    // Create a new type of tour
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'nom_tour' => 'required|string|min:3|max:100',
        ]);

        // Proceed with storing data in the database
        TypeTour::create([
            'nom_tour' => $request->input('nom_tour'),
        ]);

        // Redirect with success message
        return redirect()->route('typetour.list')->with('success', 'Type de tour ajouté avec succès!');
    }

    // Show the form to create a new type of tour
    public function create()
    {
        return view('pages.types.types-create');
    }

    // Show the form to edit an existing type of tour
    public function edit($id)
    {
        $type = TypeTour::findOrFail($id);
        return view('pages.types.types-edit', compact('type'));
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
        $validatedData = $request->validate([
            'nom_tour' => 'required|string|max:255',
        ]);

        $typeTour = TypeTour::findOrFail($id);
        $typeTour->update($validatedData);
        return to_route('typetour.list')->with('success', 'Votre type de tour a été mis à jour avec succès');
    }

    // Delete a type of tour
    public function destroy($id)
    {
        $typeTour = TypeTour::findOrFail($id);
        $typeTour->delete();
        return to_route('typetour.list')->with('success', 'Votre type de tour a été supprimé avec succès');
    }
}

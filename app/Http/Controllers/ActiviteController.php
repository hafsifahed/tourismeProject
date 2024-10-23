<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use Illuminate\Http\Request;

class ActiviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    // Get the search query from the request
    $search = $request->input('search');

    // Query the Activite model with optional search
    $activites = Activite::when($search, function ($query) use ($search) {
        return $query->where('nom', 'LIKE', "%{$search}%")
                     ->orWhere('description', 'LIKE', "%{$search}%")
                     ->orWhere('lieu', 'LIKE', "%{$search}%");
    }, function ($query) {
        return $query; // Return all activities if no search term is provided
    })->paginate(10);

    return view('pages.activites.list', compact('activites', 'search'));
}
    public function indexx()
    {
        $activites = Activite::paginate(10);
        return view('pages.activites.activities', compact('activites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.activites.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'lieu' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
        ], [
            'nom.required' => 'Le champ Nom est requis.',
            'description.required' => 'Le champ Description est requis.',
            'date.required' => 'Le champ Date est requis.',
            'lieu.required' => 'Le champ Lieu est requis.',
            'image.image' => "Le fichier doit être une image.",
            'image.mimes' => "Les formats d'image autorisés sont jpeg, png, jpg, gif et svg.",
            'image.max' => "L'image ne doit pas dépasser :max Ko.",
        ]);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            // Generate a unique filename
            $imageName = time() . '.' . $request->image->extension();
            
            // Move the uploaded file to the public/images directory
            $request->image->move(public_path('images'), $imageName);
            
            // Save the image path in validated data
            $validatedData['image'] = $imageName;
        }
    
        // Create new Activite record with validated data
        Activite::create($validatedData);
    
        // Redirect with success message
        return redirect()->route('activites.list')->with('success', 'Activité créée avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find the activity by ID and load its associated reviews and users
        $activite = Activite::with('avis.utilisateur')->findOrFail($id); // Eager load avis and their users
    
        return view('pages.activites.show', compact('activite'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activite = Activite::findOrFail($id);
        return view('pages.activites.edit', compact('activite'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'lieu' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
        ], [
            'nom.required' => 'Le champ Nom est requis.',
            'description.required' => 'Le champ Description est requis.',
            'date.required' => 'Le champ Date est requis.',
            'lieu.required' => 'Le champ Lieu est requis.',
            'image.image' => "Le fichier doit être une image.",
            'image.mimes' => "Les formats d'image autorisés sont jpeg, png, jpg, gif et svg.",
            'image.max' => "L'image ne doit pas dépasser :max Ko.",
        ]);
    
        // Find the activity by ID
        $activite = Activite::findOrFail($id);
    
        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Generate a unique filename
            $imageName = time() . '.' . $request->image->extension();
            
            // Move the uploaded file to the public/images directory
            $request->image->move(public_path('images'), $imageName);
            
            // Save the image path in validated data
            $validatedData['image'] = $imageName;
        }
    
        // Update the activity record with validated data
        $activite->update($validatedData);
    
        // Redirect with success message
        return redirect()->route('activites.list')->with('success', 'Activité mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activite = Activite::findOrFail($id);
        $activite->delete();

        return redirect()->route('activites.list')->with('success', 'Activité supprimée avec succès.');
    }
}

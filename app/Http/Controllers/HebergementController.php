<?php

namespace App\Http\Controllers;
use App\Models\Hebergement;
use Illuminate\Http\Request;

class HebergementController extends Controller
{
        // Afficher tous les hébergements
        public function index()
        {
            $accommodations = Hebergement::all();
            return view('pages.Hebergement.index', compact('accommodations'));
        }
    
        // Afficher le formulaire de création
        public function create()
        {
            return view('pages.Hebergement.create');
        }
    
        // Stocker un nouvel hébergement
        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|string',
                'region' => 'required|string',
                'address' => 'required|string',
                'description' => 'nullable|string',
                'price_per_night' => 'required|numeric',
                'certification' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation de l'image
            ]);
    
            // Gestion de l'upload de l'image
            if ($request->hasFile('image')) {
                $imageName = time().'.'.$request->image->extension();  
                $request->image->move(public_path('images'), $imageName);
                $validatedData['image'] = $imageName;
            }
    
            
    
            Hebergement::create($validatedData);
    
            return redirect()->route('hebergement.index')->with('success', 'Hébergement créé avec succès.');
        }
    
        // Afficher un hébergement
        public function show( $id)
        {
            $accommodation = Hebergement::findOrFail($id);
            return view('pages.Hebergement.show', compact('accommodation'));
        }
    
        // Afficher le formulaire d'édition
        public function edit( $id)
        {
            $accommodation = Hebergement::findOrFail($id);
            return view('pages.Hebergement.edit', compact('accommodation'));
        }
    
        public function update(Request $request, $id)
        {
            // Validation des champs
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|string',
                'region' => 'required|string',
                'address' => 'required|string',
                'description' => 'nullable|string',
                'price_per_night' => 'required|numeric',
                'certification' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        
            // Récupération de l'hébergement à mettre à jour
            $accommodation = Hebergement::findOrFail($id);
        
            // Gestion de l'image si elle est uploadée
            if ($request->hasFile('image')) {
                // Supprimer l'ancienne image si elle existe
                if ($accommodation->image && file_exists(public_path('images/' . $accommodation->image))) {
                    unlink(public_path('images/' . $accommodation->image));
                }
        
                // Enregistrer la nouvelle image
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $imageName);
        
                // Ajouter la nouvelle image aux données à mettre à jour
                $validatedData['image'] = $imageName;
            }
        
            // Mise à jour des autres champs
            $accommodation->update($validatedData);
        
            // Redirection après mise à jour
            return redirect()->route('hebergement.index')->with('success', 'Hébergement mis à jour.');
        }
        
    
        // Supprimer un hébergement
        public function destroy( $id)
        {
            $accommodation = Hebergement::findOrFail($id);
            $accommodation->delete();
           
            return redirect()->route('hebergement.index')->with('success', 'Hébergement supprimé.');
        }
    
}

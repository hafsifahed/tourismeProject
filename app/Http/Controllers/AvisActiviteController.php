<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\AvisActivite;
use Illuminate\Http\Request;

class AvisActiviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    // Initialize variables
    $avis = collect(); // Start with an empty collection for reviews
    $activites = Activite::with('avis')->get(); // Fetch all activities with their reviews

    // Check if the user is authenticated
    if (auth()->check()) {
        // Retrieve reviews based on user role
        if (auth()->user()->role === 'user') {
            // Get only the reviews of the connected user
            $avis = AvisActivite::where('utilisateur_id', auth()->id())->paginate(10);
        } elseif (auth()->user()->role === 'admin') {
            // Get all reviews with their activities and users
            $avis = AvisActivite::with(['activite', 'utilisateur'])->paginate(10);
        }
    } else {
        // If the user is not logged in, retrieve all reviews
        $avis = AvisActivite::paginate(10);
    }

    // Prepare data for chart
    $averageRatings = [];
    foreach ($activites as $activite) {
        $averageRatings[$activite->nom] = $activite->avis->avg('note') ?: 0; // Default to 0 if no reviews
    }

    return view('pages.avisactivites.index', compact('avis', 'activites', 'averageRatings'));
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'activite_id' => 'required|exists:activites,id',
            'utilisateur_id' => 'required|exists:users,id',
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string',
        ], [
            'activite_id.required' => 'Le champ Activité est requis.',
            'activite_id.exists' => 'L\'activité sélectionnée est invalide.',
            'utilisateur_id.required' => 'Le champ Utilisateur est requis.',
            'utilisateur_id.exists' => 'L\'utilisateur sélectionné est invalide.',
            'note.required' => 'Le champ Note est requis.',
            'note.integer' => 'Le champ Note doit être un entier.',
            'note.min' => 'Le champ Note doit être au moins :min.',
            'note.max' => 'Le champ Note ne doit pas dépasser :max.',
            'commentaire.string' => 'Le champ Commentaire doit être une chaîne de caractères.',
        ]);

        AvisActivite::create($request->all());
        return redirect()->route('avis.list')->with('success', 'Avis créé avec succès.');
    }

 /**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function show($id)
{
    // Récupérer l'avis par son ID
    $avis = AvisActivite::findOrFail($id);

    // Passer l'avis à la vue
    return view('pages.avisactivites.show', compact('avis'));
}
/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function edit($id)
{
    // Récupérer l'avis par son ID
    $avis = AvisActivite::findOrFail($id);

    // Passer l'avis à la vue d'édition
    return view('pages.avisactivites.edit', compact('avis'));
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
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string',
        ], [
            'note.required' => 'Le champ Note est requis.',
            'note.integer' => 'Le champ Note doit être un entier.',
            'note.min' => 'La Note doit être au moins :min.',
            'note.max' => 'La Note ne doit pas dépasser :max.',
        
            'commentaire.string' => 'Le champ Commentaire doit être une chaîne de caractères.',
        ]);

        $avis = AvisActivite::findOrFail($id);
        $avis->update($request->all());
        return redirect()->route('avis.list')->with('success', 'Avis mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $avis = AvisActivite::findOrFail($id);

        $avis->delete();
        return redirect()->route('avis.list')->with('success', 'Avis supprimé avec succès.');
    }
}



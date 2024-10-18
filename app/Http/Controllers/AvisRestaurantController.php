<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AvisRestaurant;
use App\Models\User;
use Debugbar;
use Illuminate\Support\Facades\Auth;

class AvisRestaurantController extends Controller
{
    public function index()
    {
        $avis_restaurants = AvisRestaurant::with(['user', 'restaurant'])->paginate(10);
        return view('pages.avis-restaurant.list', compact('avis_restaurants'));
    }

    public function destroy($id)
    {
        $avis_restaurant = AvisRestaurant::findOrFail($id);
        $avis_restaurant->delete();
        return redirect()->route('avis.restaurant.list')->with('success', 'Avis Restaurant Supprimer!');
    }

    public function destroyClient($id)
    {
        $avis_restaurant = AvisRestaurant::findOrFail($id);
        $avis_restaurant->delete();
        return redirect()->route('restaurant.list.client')->with('success', 'Avis Restaurant Supprimer!');
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|integer|between:1,5',
            'commentaire' => 'required|string|max:500',
        ], [
            'note.between' => 'La note doit être entre 1 et 5.',
            'commentaire.max' => 'Le commentaire ne peut pas dépasser 500 caractères.',
            'note.required' => 'La note est obligatoire.',
            'commentaire.required' => 'Le commentaire est obligatoire.',
        ]);


        AvisRestaurant::create([
            'id_restaurant' => $id,
            'id_utilisateur' => '3',
            'note' => $request->input('note'),
            'commentaire' => $request->input('commentaire'),
        ]);

        return redirect()->back()->with('success', 'Avis ajouté avec succès!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|integer|between:1,5',
            'commentaire' => 'required|string|max:500',
        ]);

        $avis = AvisRestaurant::findOrFail($id);
        $avis->update([
            'note' => $request->input('note'),
            'commentaire' => $request->input('commentaire'),
        ]);

        return redirect()->back()->with('success', 'Avis modifié avec succès!');
    }
}

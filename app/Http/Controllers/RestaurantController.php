<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use Debugbar;

class RestaurantController extends Controller
{
    public function index()
    {
        Debugbar::info('RestaurantController.index');
        $restaurants = Restaurant::paginate(10);
        return view('pages.restaurant.restaurant-list', compact('restaurants'));
    }

    public function create()
    {
        Debugbar::info('RestaurantController.create');
        return view('pages.restaurant.restaurant-create');
    }

    public function store(Request $request)
    {
        Debugbar::info('RestaurantController.store');
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string',
            'ville' => 'nullable|string',
            'code_postal' => 'nullable|string|max:10',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'site_web' => 'nullable|url',
            'type_cuisine' => 'nullable|string',
            'certification_bio' => 'required|boolean',
            'produits_locaux' => 'required|boolean',
            'saisonnalite' => 'required|boolean',
            'gestion_dechets' => 'required|boolean',
            'economie_eau' => 'required|boolean',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);
        Restaurant::create($request->all());
        return redirect()->route('restaurant.list')->with('success', 'Restaurant ajouter!');
    }

    public function destroy($id)
    {
        Debugbar::info('RestaurantController.destroy');
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();
        return redirect()->route('restaurant.list')->with('success', 'Restaurant Supprimer!');
    }

    public function edit($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('pages.restaurant.restaurant-edit', compact('restaurant'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string',
            'ville' => 'nullable|string',
            'code_postal' => 'nullable|string|max:10',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'site_web' => 'nullable|url',
            'type_cuisine' => 'nullable|string',
            'certification_bio' => 'required|boolean',
            'produits_locaux' => 'required|boolean',
            'saisonnalite' => 'required|boolean',
            'gestion_dechets' => 'required|boolean',
            'economie_eau' => 'required|boolean',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        $restaurant = Restaurant::findOrFail($id);
        $restaurant->update($request->all());

        return redirect()->route('restaurant.list')->with('success', 'Restaurant updated successfully!');
    }

    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('pages.restaurant.restaurant', compact('restaurant'));
    }

}

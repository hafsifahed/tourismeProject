<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AvisRestaurant;
use Debugbar;

class AvisRestaurantController extends Controller
{
    public function index()
    {
        Debugbar::info('AvisRestaurantController.index');
        $avis_restaurants = AvisRestaurant::with(['user', 'restaurant'])->paginate(10);
        return view('pages.avis-restaurant.list', compact('avis_restaurants'));
    }

    public function destroy($id)
    {
        Debugbar::info('AvisRestaurantController.destroy');
        $avis_restaurant = AvisRestaurant::findOrFail($id);
        $avis_restaurant->delete();
        return redirect()->route('avis.restaurant.list')->with('success', 'Avis Restaurant Supprimer!');
    }
}

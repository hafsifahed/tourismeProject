<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReservationRestaurant;
use Debugbar;

class ReservationRestaurantController extends Controller
{
    public function index()
    {
        $reservationsrestaurant = ReservationRestaurant::paginate(10);
        return view('pages.reservation.reservation-list', compact('reservationsrestaurant'));
    }

    public function destroy($id)
    {
        $reservationsrestaurant = ReservationRestaurant::findOrFail($id);
        $reservationsrestaurant->delete();
        return redirect()->route('reservation.restaurant.list')->with('success', 'reservation Restaurant Supprimer!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_restaurant' => 'required|integer|exists:restaurants,id_restaurant',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ], [
            'date_debut.required' => 'La date de début est obligatoire.',
            'date_fin.required' => 'La date de fin est obligatoire.',
            'date_debut.after_or_equal' => 'La date de début doit être supérieure ou égale à la date d\'aujourd\'hui.',
            'date_fin.after_or_equal' => 'La date de fin doit être supérieure ou égale à la date de début.',
        ]);

        ReservationRestaurant::create([
            'id_restaurant' => $request->input('id_restaurant'),
            'id_utilisateur' => auth()->id(),
            'date_debut' => $request->input('date_debut'),
            'date_fin' => $request->input('date_fin'),
        ]);

        return redirect()->back()->with('success', 'Réservation effectuée avec succès!');
    }
}

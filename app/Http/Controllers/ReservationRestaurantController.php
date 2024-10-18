<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReservationRestaurant;
use Debugbar;

class ReservationRestaurantController extends Controller
{
    public function index()
    {
        Debugbar::info('ReservationRestaurantController.index');
        $reservationsrestaurant = ReservationRestaurant::paginate(10);
        return view('pages.reservation.reservation-list', compact('reservationsrestaurant'));
    }

    public function destroy($id)
    {
        Debugbar::info('ReservationRestaurantController.destroy');
        $reservationsrestaurant = ReservationRestaurant::findOrFail($id);
        $reservationsrestaurant->delete();
        return redirect()->route('reservation.restaurant.list')->with('success', 'reservation Restaurant Supprimer!');
    }
}

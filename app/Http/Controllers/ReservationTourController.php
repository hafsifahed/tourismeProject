<?php

namespace App\Http\Controllers;

use App\Models\ReservationTour;
use App\Models\GuideLocal;
use App\Models\User;
use Illuminate\Http\Request;

class ReservationTourController extends Controller
{
    public function index()
    {
        $reservations = ReservationTour::with(['guideLocal', 'utilisateur'])->get();
        return view('pages.reservation.reservation-list', compact('reservations'));
    }

    public function create() {
        $guides = GuideLocal::all();
        $utilisateur = User::all();
        return view('pages.reservation.reservation-create', compact('guides', 'utilisateur'));
    }

    public function edit($id) {
        $reservation = ReservationTour::findOrFail($id);
        $guides = GuideLocal::all();
        $utilisateur = User::all();
        return view('pages.reservation.reservation-edit', compact('reservation', 'guides', 'utilisateur'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'guide_local' => 'required|exists:guides_locaux,id',
            'utilisateur' => 'required|exists:users,id',
            'informations' => 'required|string',
        ]);

        ReservationTour::create($validatedData);
        return to_route('reservationtour.list')->with('success', "Réservation de tour créée avec succès");
    }

    public function update(Request $request, $id)
    {
        $reservation = ReservationTour::findOrFail($id);
        $reservation->update($request->all());
        return to_route('reservationtour.list')->with('success', "Réservation de tour mise à jour avec succès");
    }

    public function destroy($id)
    {
        $reservation = ReservationTour::findOrFail($id);
        $reservation->delete();
        return to_route('reservationtour.list')->with('success', "Réservation de tour supprimée avec succès");
    }
}

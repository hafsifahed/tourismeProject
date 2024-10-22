<?php

namespace App\Http\Controllers;

use App\Models\ReservationTour;
use App\Models\GuideLocal;
use App\Models\User;
use Illuminate\Http\Request;

class ReservationTourController extends Controller
{
    // Retrieve all reservations
    public function index()
    {
        $reservations = ReservationTour::with(['guideLocal','utilisateur'])->get();
        //dd($reservations);
        return view('pages.reservation.reservation-list', compact('reservations'));
    }

    public function create() {
        $guides = GuideLocal::all();
        $utilisateurs = User::all();
        return view('pages.reservation.reservation-create', compact('guides', 'utilisateurs'));
    }

    public function edit($id) {
        $reservation = ReservationTour::findOrFail($id);
        $guides = GuideLocal::all();
        $utilisateur = User::all();
        return view('pages.reservation.reservation-edit', compact('reservation', 'guides', 'utilisateur'));
    }

    // Create a new reservation
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'guide_local' => 'required|exists:guides_locaux,id',
            'utilisateur' => 'required|exists:users,id',
            'informations' => 'required|string',
        ]);

        //$reservation = 
        ReservationTour::create($validatedData);
        //return response()->json($reservation, 201);
        return to_route('reservationtour.list')->with('success', "Reservation de tour cree avec succes");
    }

    // Retrieve a specific reservation by ID
    public function show($id)
    {
        $reservation = ReservationTour::findOrFail($id);
        return response()->json($reservation);
    }

    // Update a reservation
    public function update(Request $request, $id)
    {
        $reservation = ReservationTour::findOrFail($id);
        $reservation->update($request->all());
        return to_route('reservationtour.list')->with('success', "Reservation de tour mise a jour avec succes");
    }

    // Delete a reservation
    public function destroy($id)
    {
        $reservation = ReservationTour::findOrFail($id);
        $reservation->delete();
        return to_route('reservationtour.list')->with('success', "Reservation de tour supprimee avec succes");
    }
}

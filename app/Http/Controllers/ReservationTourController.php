<?php

namespace App\Http\Controllers;

use App\Models\ReservationTour;
use Illuminate\Http\Request;

class ReservationTourController extends Controller
{
    // Retrieve all reservations
    public function index()
    {
        return ReservationTour::all();
    }

    // Create a new reservation
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'guide_local' => 'required|exists:guides_locaux,id',
            'utilisateur' => 'required|exists:users,id',
            'informations' => 'required|string',
        ]);

        $reservation = ReservationTour::create($validatedData);
        return response()->json($reservation, 201);
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
        return response()->json($reservation, 200);
    }

    // Delete a reservation
    public function destroy($id)
    {
        $reservation = ReservationTour::findOrFail($id);
        $reservation->delete();
        return response()->json(null, 204);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\ReservationActivite;
use App\Models\User;
use Illuminate\Http\Request;

class ReservationActiviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = ReservationActivite::paginate(10);
        return view('pages.reservationactivites.index', compact('reservations'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activites = Activite::all();
        $utilisateurs = User::all();
        return view('pages.reservationactivites.create', compact('activites','utilisateurs'));
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
            'utilisateur_id' => 'required|exists:users,id', // Assuming you have a User model
            'nombre_places' => 'required|integer|min:1',
        ]);

        ReservationActivite::create($request->all());
        return redirect()->route('reservations.list')->with('success', 'Réservation créée avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservation = ReservationActivite::findOrFail($id);
        return view('pages.reservationactivites.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activites = Activite::all();
        $reservation = ReservationActivite::findOrFail($id);
        return view('pages.reservationactivites.edit', compact('reservation','activites'));
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
            'nombre_places' => 'required|integer|min:1',
        ]);
        $reservation = ReservationActivite::findOrFail($id);
        $reservation->update($request->all());
        return redirect()->route('reservations.list')->with('success', 'Réservation mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = ReservationActivite::findOrFail($id);
        $reservation->delete();
        return redirect()->route('reservations.list')->with('success', 'Réservation supprimée avec succès.');
    }
}

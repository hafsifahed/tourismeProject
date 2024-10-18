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
    public function index(Request $request)
{
    // Get the search query from the request
    $search = $request->input('search');

    // Query the ReservationActivite model with optional search
    $reservations = ReservationActivite::with('activite', 'utilisateur') // Eager load relationships
        ->when($search, function ($query) use ($search) {
            return $query->whereHas('activite', function ($query) use ($search) {
                $query->where('nom', 'LIKE', "%{$search}%");
            })->orWhereHas('utilisateur', function ($query) use ($search) {
                $query->where('email', 'LIKE', "%{$search}%"); // Assuming 'name' is a field in User model
            });
        })
        ->paginate(10);

    return view('pages.reservationactivites.index', compact('reservations', 'search'));
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

    public function storee(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'activite_id' => 'required|exists:activites,id',
            'nombre_places' => 'required|integer|min:1', // Ensure this is included
        ]);
    
        // Fetch user ID from authenticated session
        $userId = auth()->id(); 
        
    
        // Create a new reservation
        ReservationActivite::create([
            'activite_id' => $request->input('activite_id'),
            'utilisateur_id' => $userId,
            'nombre_places' => $request->input('nombre_places'), // Use user input here
        ]);
    
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

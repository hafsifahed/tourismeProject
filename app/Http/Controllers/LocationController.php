<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Debugbar;
use App\Models\LocationTransport;
use App\Models\Transport;
use App\Models\User;



class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Debugbar::info('LocationController.index');
        $locationTransports = LocationTransport::with('transport', 'user')->get(); // Chargez les relations
        return view('pages.location-list', compact('locationTransports'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Debugbar::info('LocationController.create');

        // Récupérer tous les transports et utilisateurs pour les afficher dans la vue
        $transports = Transport::all(); // Récupérer tous les transports
        $users = User::all(); // Récupérer tous les utilisateurs

        // Retourner la vue avec les variables transports et users
        return view('pages.location-create', compact('transports', 'users'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Debugbar::info('LocationTransportController.store');

        // Règles de validation pour les attributs de LocationTransport
        $request->validate([
            'id_transport' => 'required|exists:transports,id_transport', // Vérifie que l'ID du transport existe
            'user_id' => 'required|exists:users,id', // Vérifie que l'ID de l'utilisateur existe
            'date_debut' => 'required|date|before_or_equal:date_fin', // Date de début obligatoire et avant ou égale à la date de fin
            'date_fin' => 'required|date|after_or_equal:date_debut', // Date de fin obligatoire et après ou égale à la date de début
            'status' => 'required|string|in:Active,Completed,Cancelled', // Le statut est obligatoire
            'prix_total' => 'required|numeric|min:0', // Le prix total est obligatoire et doit être un nombre positif
        ]);

        // Récupération du transport associé à partir de l'id_transport
        $transport = Transport::findOrFail($request->id_transport);

        // Création de la location de transport
        LocationTransport::create([
            'id_transport' => $request->id_transport,
            'user_id' => $request->user_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'status' => $request->status,
            'prix_total' => $request->prix_total,
            // Si vous devez stocker le type directement dans LocationTransport (si le champ existe)
            // 'type' => $transport->type,  // Ajoutez ceci seulement si la table LocationTransport a une colonne 'type'
        ]);

        // Redirection avec un message de succès incluant le type de transport récupéré
        return redirect()->route('location.list')->with('success', 'Location de transport ajoutée avec succès pour le type: ' . $transport->type . '!');
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    $location = LocationTransport::findOrFail($id);
    $transports = Transport::all(); // Get all transports
    $users = User::all(); // Get all users
    return view('pages.location-edit', compact('location', 'transports', 'users'));
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
        // Validate the incoming request data
        $request->validate([
            'id_transport' => 'required|exists:transports,id_transport', // Ensure the transport ID exists
            'user_id' => 'required|exists:users,id', // Ensure the user ID exists
            'date_debut' => 'required|date|before_or_equal:date_fin', // Start date must be before or equal to end date
            'date_fin' => 'required|date|after_or_equal:date_debut', // End date must be after or equal to start date
            'status' => 'required|string|in:Active,Completed,Cancelled', // Status must be one of the allowed values
            'prix_total' => 'required|numeric|min:0', // Total price must be a non-negative number
        ]);

        // Find the LocationTransport by ID or fail if not found
        $locationTransport = LocationTransport::findOrFail($id);

        // Update the LocationTransport record with the validated data
        $locationTransport->update([
            'id_transport' => $request->id_transport,
            'user_id' => $request->user_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'status' => $request->status,
            'prix_total' => $request->prix_total,
        ]);

        // Redirect back to the location list with a success message
        return redirect()->route('location.list')->with('success', 'Location de transport mise à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $locationTransport = LocationTransport::findOrFail($id);
        $locationTransport->delete();

        return redirect()->route('location.list')->with('success', 'Location deleted successfully.');
    }

    public function louerTransport(Request $request)
    {
        // Validate the form data
        $request->validate([
            'id_transport' => 'required|exists:transports,id_transport',
            'user_id' => 'required|exists:users,id',
            'date_debut' => 'required|date|before_or_equal:date_fin',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);
    
        // Retrieve the transport details
        $transport = Transport::findOrFail($request->id_transport);
    
        // Calculate the total price based on the duration
        $startDate = new \DateTime($request->date_debut);
        $endDate = new \DateTime($request->date_fin);
        $interval = $startDate->diff($endDate);
    
        // Calculate total hours
        $hours = ($interval->days * 24) + $interval->h;
        $prix_total = $hours * $transport->prix_heure;
    
        // Create a new rental (LocationTransport)
        LocationTransport::create([
            'id_transport' => $request->id_transport,
            'user_id' => $request->user_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'status' => 'Active',
            'prix_total' => $prix_total,
        ]);
    
        // Redirect with success message
        return redirect()->route('transport.show', ['id' => $request->id_transport])
            ->with('success', 'Transport loué avec succès!');
    }
    
    
    


}

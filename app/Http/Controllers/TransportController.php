<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Debugbar;
use App\Models\Transport;


class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Debugbar::info('TransportController.index');
        $transport = Transport::all();
        return view('pages.transport-list', compact('transport'));

    }

    public function index1()
    {
        Debugbar::info('TransportController.index1');
        
        // Récupérer les modèles uniques et lieux de location depuis la base de données
        $models = Transport::select('model')->distinct()->pluck('model');
        $lieux = Transport::select('lieux_location')->distinct()->pluck('lieux_location');
    
        // Récupérer les transports paginés
        $transport = Transport::paginate(6);
    
        // Passer les modèles et lieux à la vue
        return view('pages.fronttransport', compact('transport', 'models', 'lieux'));
    }
    

    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Debugbar::info('TransportController.create');
        return view('pages.transport-create');
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
            'type' => 'required|string',
            'model' => 'required|string',
            'status' => 'required|string',
            'prix_heure' => 'required|numeric|min:0',
            'battrie' => 'required|integer|min:0|max:100',
            'lieux_location' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
        ]);

        // Gérer le téléchargement de l'image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('transports', 'public');
        }

        // Enregistrement du transport
        Transport::create([
            'type' => $request->input('type'),
            'model' => $request->input('model'),
            'status' => $request->input('status'),
            'prix_heure' => $request->input('prix_heure'),
            'battrie' => $request->input('battrie'),
            'lieux_location' => $request->input('lieux_location'),
            'image_url' => $imagePath, // Enregistrer le chemin de l'image
        ]);

        return redirect()->route('transport.list')->with('success', 'Transport ajouté avec succès!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_transport)
    {
        $transport = Transport::where('id_transport', $id_transport)->firstOrFail();
    
        // Utilisez le bon chemin pour la vue
        return view('pages.show', compact('transport'));
    }
    
    
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transport = Transport::findOrFail($id);
        return view('pages.transport-edit', compact('transport'));
    }


    public function detailsTransport($id)
    {
        // Récupérer le transport par ID
        $transport = Transport::findOrFail($id);
    
        // Passer les données à la vue
        return view('pages.Transport.UI_detailsTransport', compact('transport'));
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
            'type' => 'required|string|max:255',
            'model' => 'required|string',
            'status' => 'nullable|string',
            'prix_heure' => 'nullable',
            'battrie' => 'nullable',
            'lieux_location' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);
        $transport = Transport::findOrFail($id);
        $transport->update($request->all());

        return redirect()->route('transport.list')->with('success', 'transport updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function destroy($id)
     {
         Debugbar::info('TransportController.destroy');
         $transport = Transport::findOrFail($id);
         $transport->delete();
         return redirect()->route('transport.list')->with('success', 'transport Supprimer!');
     }



     public function search(Request $request)
     {
         // Commencer une nouvelle requête sur le modèle Transport
         $query = Transport::query();
     
         // Appliquer les filtres si les champs sont remplis
         if ($request->filled('model')) {
             $query->where('model', $request->input('model'));
         }
     
         if ($request->filled('type')) {
             $query->where('type', $request->input('type'));
         }
     
         if ($request->filled('lieux_location')) {
             $query->where('lieux_location', 'like', '%' . $request->input('lieux_location') . '%');
         }
     
         if ($request->filled('prix_min')) {
             $query->where('prix_heure', '>=', $request->input('prix_min'));
         }
     
         if ($request->filled('prix_max')) {
             $query->where('prix_heure', '<=', $request->input('prix_max'));
         }
     
         // Obtenir les résultats filtrés
         $transport = $query->paginate(6);
     
         // Récupérer les modèles et lieux distincts pour le formulaire de filtre
         $models = Transport::select('model')->distinct()->pluck('model');
         $lieux = Transport::select('lieux_location')->distinct()->pluck('lieux_location');
     
         // Retourner la vue avec les résultats filtrés
         return view('pages.fronttransport', compact('transport', 'models', 'lieux'));
     }
     
}

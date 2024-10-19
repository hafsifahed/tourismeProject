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
        Debugbar::info('TransportController.store');

        // Règles de validation pour chaque champ
        $request->validate([
            'type' => 'required|string|max:255', // Le type est obligatoire et doit être une chaîne de caractères
            'model' => 'required|string|max:255', // Le modèle est obligatoire et doit être une chaîne de caractères
            'status' => 'required|string|in:Available,Not Available', // Le statut est obligatoire avec des valeurs prédéfinies
            'prix_heure' => 'required|numeric|min:0', // Le prix par heure est obligatoire, doit être un nombre positif
            'battrie' => 'required|numeric|min:0|max:100', // La batterie est obligatoire, doit être entre 0 et 100
            'lieux_location' => 'required|string|max:255', // Le lieu de location est obligatoire
            'image_url' => 'nullable|url|max:2048', // L'URL de l'image est optionnelle mais doit être valide si présente
        ]);

        // Création du transport
        Transport::create($request->all());

        // Redirection avec un message de succès
        return redirect()->route('transport.list')->with('success', 'Transport ajouté avec succès!');
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
        $transport = Transport::findOrFail($id);
        return view('pages.transport-edit', compact('transport'));
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
}

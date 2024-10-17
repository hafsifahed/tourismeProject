<?php

namespace App\Http\Controllers;

use App\Models\AvisActivite;
use Illuminate\Http\Request;

class AvisActiviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $avis = AvisActivite::paginate(10); // Fetch all reviews with associated activities
        return view('pages.avisactivites.index', compact('avis'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string',
        ]);

        AvisActivite::create($request->all());
        return redirect()->route('avis.index')->with('success', 'Avis créé avec succès.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AvisActivite $avis)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string',
        ]);

        $avis->update($request->all());
        return redirect()->route('avis.index')->with('success', 'Avis mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AvisActivite $avis)
    {
        $avis->delete();
        return redirect()->route('avis.index')->with('success', 'Avis supprimé avec succès.');
    }
}

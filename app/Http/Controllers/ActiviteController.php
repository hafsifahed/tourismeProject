<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use Illuminate\Http\Request;

class ActiviteController extends Controller
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

    // Query the Activite model with optional search
    $activites = Activite::when($search, function ($query) use ($search) {
        return $query->where('nom', 'LIKE', "%{$search}%")
                     ->orWhere('description', 'LIKE', "%{$search}%")
                     ->orWhere('lieu', 'LIKE', "%{$search}%");
    }, function ($query) {
        return $query; // Return all activities if no search term is provided
    })->paginate(10);

    return view('pages.activites.list', compact('activites', 'search'));
}
    public function indexx()
    {
        $activites = Activite::paginate(10);
        return view('pages.activites.activities', compact('activites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.activites.create');
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
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'lieu' => 'required|string|max:255',
        ]);

        Activite::create($request->all());

        return redirect()->route('activites.list')->with('success', 'Activité créée avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activite = Activite::findOrFail($id);
        return view('pages.activites.show', compact('activite'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activite = Activite::findOrFail($id);
        return view('pages.activites.edit', compact('activite'));
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
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'lieu' => 'required|string|max:255',
        ]);

        $activite = Activite::findOrFail($id);
        $activite->update($request->all());

        return redirect()->route('activites.list')->with('success', 'Activité mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activite = Activite::findOrFail($id);
        $activite->delete();

        return redirect()->route('activites.list')->with('success', 'Activité supprimée avec succès.');
    }
}

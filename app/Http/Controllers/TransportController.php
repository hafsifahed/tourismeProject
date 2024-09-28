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
        Debugbar::info('RestaurantController.store');
        $request->validate([
            'type' => 'required|string|max:255',
            'model' => 'required|string',
            'status' => 'nullable|string',
            'prix_heure' => 'nullable',
            'battrie' => 'nullable',
            'lieux_location' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);
        Transport::create($request->all());
        return redirect()->route('transport.list')->with('success', 'transport ajouter!');
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

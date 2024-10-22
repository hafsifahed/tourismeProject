<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuideLocal;
use Debugbar;
use App\Models\TypeTour;

class GuideLocalController extends Controller
{
    public function index()
    {
        Debugbar::info('GuideLocauxController.index');
        $guides = GuideLocal::paginate(10);
        return view('pages.guide.guide-list', compact('guides'));
    }

    public function create()
    {
        $types = TypeTour::all();
        Debugbar::info('GuideLocauxController.create');
        return view('pages.guide.guide-create', compact('types'));
    }

    public function store(Request $request)
    {
        Debugbar::info('GuideLocauxController.store');
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'region' => 'nullable|string',
            'ville' => 'nullable|string',
            'type_tours' => 'nullable|string',
            'disponibilites' => 'nullable|string',
            'experience_annees' => 'nullable|integer',
            'langues_parlees' => 'nullable|string',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'site_web' => 'nullable|url',
            'certification' => 'required|boolean',
            'tour_groupe' => 'required|boolean',
            'tour_prive' => 'required|boolean',
            'commentaires' => 'nullable|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Add file upload validation
        ]);

        // Handle the file upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public'); // Store photo in public/photos directory
        }

        // Create the guide with the photo path
        GuideLocal::create([
            ...$request->except('photo'), // Exclude the photo field from the request
            'photo_url' => $photoPath, // Store the photo path in the database
        ]);

        return redirect()->route('guidelocal.list')->with('success', 'Guide local ajouté!');
    }

    public function destroy($id)
    {
        Debugbar::info('GuideLocauxController.destroy');
        $guide = GuideLocal::findOrFail($id);
        $guide->delete();
        return redirect()->route('guidelocal.list')->with('success', 'Guide local supprimé!');
    }

    public function edit($id)
    {
        $guide = GuideLocal::findOrFail($id);
        $types = TypeTour::all();
        return view('pages.guide.guide-edit', compact('guide', 'types'));
    }

    public function update(Request $request, $id)
    {
        Debugbar::info('GuideLocauxController.update');
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'region' => 'nullable|string',
            'ville' => 'nullable|string',
            'type_tours' => 'nullable|string',
            'disponibilites' => 'nullable|string',
            'experience_annees' => 'nullable|integer',
            'langues_parlees' => 'nullable|string',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'site_web' => 'nullable|url',
            'certification' => 'required|boolean',
            'tour_groupe' => 'required|boolean',
            'tour_prive' => 'required|boolean',
            'commentaires' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow photo upload
        ]);

        $guide = GuideLocal::findOrFail($id);
        $data = $request->except('photo'); // Exclude photo from the update request

        // Handle file upload if a new photo is provided
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public'); // Store photo in public/photos directory
            $data['photo_url'] = $photoPath; // Update the photo path
        }

        $guide->update($data); // Update the guide with the new data

        return redirect()->route('guidelocal.list')->with('success', 'Guide local mis à jour!');
    }

    public function show($id)
    {
        $guide = GuideLocal::findOrFail($id);
        return view('pages.guide.guide', compact('guide'));
    }
}

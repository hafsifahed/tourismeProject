<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuideLocal;
use Debugbar;

class GuidesLocauxController extends Controller
{
    public function index()
    {
        Debugbar::info('GuideLocauxController.index');
        $guides = GuideLocal::paginate(10);
        return view('pages.guide.guide-list', compact('guides'));
    }

    public function create()
    {
        Debugbar::info('GuideLocauxController.create');
        return view('pages.guide.guide-create');
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
            'photo_url' => 'nullable|url',
        ]);

        GuideLocal::create($request->all());
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
        return view('pages.guide.guide-edit', compact('guide'));
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
            'photo_url' => 'nullable|url',
        ]);

        $guide = GuideLocal::findOrFail($id);
        $guide->update($request->all());

        return redirect()->route('guidelocal.list')->with('success', 'Guide local mis à jour!');
    }

    public function show($id)
    {
        $guide = GuideLocal::findOrFail($id);
        return view('pages.guide.guide', compact('guide'));
    }
}

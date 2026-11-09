<?php

namespace App\Http\Controllers;

use App\Models\Personne;
use App\Models\Participe;
use App\Models\RolePersonne;
use Illuminate\Http\Request;

class ScenaristeController extends Controller
{
    public function index()
    {
        $scenaristes = Personne::whereHas('rolepersonne', function ($q) {
            $q->where('libRolePer', 'Scenariste');
        })->get();

        return view('pages.gestion-scenariste', compact('scenaristes'));
    }

    public function create()
    {
        return view('pages.ajout-scenariste');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomPer'      => 'required|string|max:255',
            'prenomPer'   => 'required|string|max:255',
            'bioPer'      => 'nullable|string',
            'dateNaisPer' => 'required|date',
            'lieuNaisPer' => 'required|string|max:255',
        ]);

        $scenariste = new Personne();
        $scenariste->nomPer      = $validated['nomPer'];
        $scenariste->prenomPer   = $validated['prenomPer'];
        $scenariste->bioPer      = $validated['bioPer'] ?? null;
        $scenariste->dateNaisPer = $validated['dateNaisPer'];
        $scenariste->lieuNaisPer = $validated['lieuNaisPer'];
        $scenariste->save();

        $role = RolePersonne::where('libRolePer', 'Scenariste')->first();
        if ($role) {
            Participe::create([
                'idPer'     => $scenariste->idPer,
                'idFil'     => 1,
                'idRolePer' => $role->idRolePer,
            ]);
        }

        return redirect()
            ->route('scenariste.admin.gestion')
            ->with('success', 'Scénariste ajouté');
    }

    public function show($id)
    {
        $scenariste = Personne::whereHas('rolepersonne', function ($q) {
            $q->where('libRolePer', 'Scenariste');
        })->findOrFail($id);

        return view('pages.personne-detail', [
            'personne' => $scenariste,
            'role'     => 'scenariste',
        ]);
    }

    public function edit($id)
    {
        $scenaristes = Personne::whereHas('rolepersonne', function ($q) {
            $q->where('libRolePer', 'Scenariste');
        })->findOrFail($id);

        return view('pages.edit-scenariste', compact('scenaristes'));
    }

    public function update(Request $request, $id)
    {
        $personne = Personne::findOrFail($id);

        $validated = $request->validate([
            'nomPer'      => 'required|string|max:255',
            'prenomPer'   => 'required|string|max:255',
            'bioPer'      => 'nullable|string',
            'dateNaisPer' => 'required|date',
            'lieuNaisPer' => 'required|string|max:255',
        ]);

        $personne->nomPer      = $validated['nomPer'];
        $personne->prenomPer   = $validated['prenomPer'];
        $personne->bioPer      = $validated['bioPer'] ?? null;
        $personne->dateNaisPer = $validated['dateNaisPer'];
        $personne->lieuNaisPer = $validated['lieuNaisPer'];
        $personne->save();

        return redirect()
            ->route('scenariste.admin.gestion')
            ->with('success', 'Scénariste modifié');
    }

    public function destroy($id)
    {
        $scenariste = Personne::findOrFail($id);
        $scenariste->delete();

        return redirect()
            ->route('scenariste.admin.gestion')
            ->with('success', 'Scénariste supprimé');
    }
}

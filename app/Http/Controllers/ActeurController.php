<?php

namespace App\Http\Controllers;

use App\Models\Personne;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\RolePersonne;
use App\Models\Participe;

class ActeurController extends Controller
{
    public function index()
    {
        $acteurs = Personne::whereHas('rolepersonne', function ($q) {
            $q->where('libRolePer', 'Acteur principal');
        })->get();

        return view('pages.gestion-acteur', compact('acteurs'));
    }

    public function create()
    {
        return view('pages.ajout-acteur');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomPer'       => 'required|string|max:255',
            'prenomPer'    => 'required|string|max:255',
            'bioPer'       => 'nullable|string',
            'dateNaisPer'  => 'required|date',
            'lieuNaisPer'  => 'required|string|max:255',
        ]);

        $acteur = new Personne();
        $acteur->nomPer      = $validated['nomPer'];
        $acteur->prenomPer   = $validated['prenomPer'];
        $acteur->bioPer      = $validated['bioPer'] ?? null;
        $acteur->dateNaisPer = $validated['dateNaisPer'];
        $acteur->lieuNaisPer = $validated['lieuNaisPer'];
        $acteur->save();

        $role = RolePersonne::where('libRolePer', 'Acteur principal')->first();
        if ($role) {
            Participe::create([
                'idPer'      => $acteur->idPer,
                'idFil'      => 1,
                'idRolePer'  => $role->idRolePer,
            ]);
        }

        return redirect()
            ->route('acteur.admin.gestion')
            ->with('success', 'Acteur ajouté');
    }

    public function show($id)
    {
        $acteur = Personne::whereHas('rolepersonne', function ($q) {
            $q->where('libRolePer', 'Acteur principal');
        })->findOrFail($id);

        return view('pages.personne-detail-admin', [
            'personne' => $acteur,
            'role'     => 'acteur',
        ]);
    }

    public function edit($id)
    {
        $acteur = Personne::whereHas('rolepersonne', function ($q) {
            $q->where('libRolePer', 'Acteur principal');
        })->findOrFail($id);

        return view('pages.edit-acteur', compact('acteur'));
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
            ->route('acteur.admin.gestion')
            ->with('success', 'Acteur mis à jour');
    }

    public function destroy($id)
    {
        $acteur = Personne::findOrFail($id);
        $acteur->delete();

        return redirect()
            ->route('acteur.admin.gestion')
            ->with('success', 'Acteur supprimé');
    }
}

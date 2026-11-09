<?php

namespace App\Http\Controllers;

use App\Models\Personne;
use App\Models\Participe;
use App\Models\RolePersonne;
use Illuminate\Http\Request;

class RealisateurController extends Controller
{
    public function index()
    {
        $realisateurs = Personne::whereHas('rolepersonne', function ($q) {
            $q->where('libRolePer', 'Realisateur');
        })->get();

        return view('pages.gestion-realisateur', compact('realisateurs'));
    }

    public function create()
    {
        return view('pages.ajout-realisateur');
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

        $realisateur = new Personne();
        $realisateur->nomPer      = $validated['nomPer'];
        $realisateur->prenomPer   = $validated['prenomPer'];
        $realisateur->bioPer      = $validated['bioPer'] ?? null;
        $realisateur->dateNaisPer = $validated['dateNaisPer'];
        $realisateur->lieuNaisPer = $validated['lieuNaisPer'];
        $realisateur->save();

        $role = RolePersonne::where('libRolePer', 'Realisateur')->first();
        if ($role) {
            Participe::create([
                'idPer'     => $realisateur->idPer,
                'idFil'     => 1,
                'idRolePer' => $role->idRolePer,
            ]);
        }

        return redirect()
            ->route('realisateur.admin.gestion')
            ->with('success', 'Réalisateur ajouté');
    }

    public function show($id)
    {
        $realisateur = Personne::whereHas('rolepersonne', function ($q) {
            $q->where('libRolePer', 'Realisateur');
        })->findOrFail($id);

        return view('pages.personne-detail-admin', [
            'personne' => $realisateur,
            'role'     => 'realisateur',
        ]);
    }

    public function edit($id)
    {
        $realisateur = Personne::whereHas('rolepersonne', function ($q) {
            $q->where('libRolePer', 'Realisateur');
        })->findOrFail($id);

        return view('pages.edit-realisateur', compact('realisateur'));
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
            ->route('realisateur.admin.gestion')
            ->with('success', 'Réalisateur modifié');
    }

    public function destroy($id)
    {
        $realisateur = Personne::findOrFail($id);
        $realisateur->delete();

        return redirect()
            ->route('realisateur.admin.gestion')
            ->with('success', 'Réalisateur supprimé');
    }
}

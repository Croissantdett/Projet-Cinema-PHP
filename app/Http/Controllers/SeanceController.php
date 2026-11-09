<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seance;
use App\Models\Film;
use App\Models\Salle;
use App\Models\Cinema;
use App\Models\TypeSeance;
use App\Models\Langue;

class SeanceController extends Controller
{
    public function index()
    {
        $seances = Seance::with(['film', 'salle.cinema', 'typeSeance', 'langue'])
            ->orderBy('dateHeurSea', 'desc')
            ->get();

        return view('pages.gestion-programmation', compact('seances'));
    }

    public function create()
    {
        $films       = Film::orderBy('titreFil')->get();
        $salles      = Salle::with('cinema')->orderBy('idCin')->get();
        $cinemas     = Cinema::orderBy('nomCin')->get();
        $typesSeance = TypeSeance::all();
        $langues     = Langue::all();

        return view('pages.ajout-programme', compact('films', 'salles', 'cinemas', 'typesSeance', 'langues'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dateHeurSea' => 'required|date',
            'idFil'       => 'required|exists:film,idFil',
            'idSal'       => 'required|exists:salle,idSal',
            'idTypeSea'   => 'required|exists:type_seance,idTypeSea',
            'idLangue'    => 'required|exists:langue,idLangue',
        ]);

        Seance::create($validated);

        return redirect()->route('seance.admin.gestion');
    }

    public function edit($id)
    {
        $seance      = Seance::findOrFail($id);
        $films       = Film::orderBy('titreFil')->get();
        $salles      = Salle::with('cinema')->orderBy('idCin')->get();
        $cinemas     = Cinema::orderBy('nomCin')->get();
        $typesSeance = TypeSeance::all();
        $langues     = Langue::all();

        return view('pages.edit-seance', compact('seance', 'films', 'salles', 'cinemas', 'typesSeance', 'langues'));
    }

    public function update(Request $request, $id)
    {
        $seance = Seance::findOrFail($id);

        $validated = $request->validate([
            'dateHeurSea' => 'required|date',
            'idFil'       => 'required|exists:film,idFil',
            'idSal'       => 'required|exists:salle,idSal',
            'idTypeSea'   => 'required|exists:type_seance,idTypeSea',
            'idLangue'    => 'required|exists:langue,idLangue',
        ]);

        $seance->dateHeurSea = $validated['dateHeurSea'];
        $seance->idFil       = $validated['idFil'];
        $seance->idSal       = $validated['idSal'];
        $seance->idTypeSea   = $validated['idTypeSea'];
        $seance->idLangue    = $validated['idLangue'];
        $seance->save();

        return redirect()->route('seance.admin.gestion')->with('success', 'Séance modifiée.');
    }

    public function destroy($id)
    {
        Seance::findOrFail($id)->delete();
        return redirect()->route('seance.admin.gestion')->with('success', 'Séance supprimée.');
    }
}

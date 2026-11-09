<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Personne;

class RechercheController extends Controller
{
    public function index(Request $request)
    {
        // On récupère le mot tapé par l'utilisateur
        $motCle = $request->input('q', '');

        // Si moins de 2 lettres, on renvoie une liste vide
        if (strlen($motCle) < 2) {
            return response()->json([]);
        }

        $resultats = [];

        // --- FILMS ---
        $films = Film::where('titreFil', 'LIKE', '%' . $motCle . '%')->limit(5)->get();
        foreach ($films as $film) {
            $resultats[] = [
                'type' => 'Film',
                'nom'  => $film->titreFil,
                'url'  => route('films.show', $film->idFil),
                'img'  => $film->imgFil,
            ];
        }

        // --- PERSONNES (acteurs, réalisateurs, scénaristes) ---
        $roles = ['Acteur principal', 'Realisateur', 'Scenariste'];


        foreach ($roles as $role) {
            $personnes = Personne::whereHas('roles', function($query) use ($role) {
                $query->where('libRolePer', $role);
            })
                ->where(function($query) use ($motCle) {
                    $query->where('nomPer', 'LIKE', '%' . $motCle . '%')
                        ->orWhere('prenomPer', 'LIKE', '%' . $motCle . '%');
                })
                ->limit(4)
                ->get();

            foreach ($personnes as $personne) {
                $resultats[] = [
                    'type' => $role,
                    'nom'  => $personne->prenomPer . ' ' . $personne->nomPer,
                    'url'  => '#',
                    'img'  => null,
                ];
            }
        }

        return response()->json($resultats);
    }
}

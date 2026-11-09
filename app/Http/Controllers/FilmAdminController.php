<?php

namespace App\Http\Controllers;

use App\Models\Langue;
use App\Models\TypeSalle;
use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Personne;
use Carbon\Carbon;


class FilmAdminController extends Controller
{
    public function index(Request $request)
    {
        $genres = Genre::orderBy('libGenre')->get();
        $selectedGenres = array_map('intval', $request->input('genres', []));
        $recherche = $request->input('recherche');
        $query = Film::query();
        if (!empty($selectedGenres)) {
            $query->whereIn('idGenre', $selectedGenres);
        }
        if (!empty($recherche)) {
            $query->where('titreFil', 'LIKE', '%' . $recherche . '%');
        }

        $films = $query->get();

        return view('pages.gestion_films-admin', compact('films', 'genres', 'selectedGenres'));
    }

    public function tousFilm(Request $request)
    {
        $genres = Genre::orderBy('libGenre')->get();
        $selectedGenres = array_map('intval', $request->input('genres', []));
        $recherche = $request->input('recherche');
        $query = Film::query();
        if (!empty($selectedGenres)) {
            $query->whereIn('idGenre', $selectedGenres);
        }
        if (!empty($recherche)) {
            $query->where('titreFil', 'LIKE', '%' . $recherche . '%');
        }

        $films = $query->get();

        return view('pages.tous_films-admin', compact('films', 'genres', 'selectedGenres'));
    }

    public function show(Film $film)
    {
        $film->load('genre');

        return view('pages.film-admin', compact('film'));
    }

    public function destroy($id)
    {
        $film = \App\Models\Film::find($id);
        $film->personnes()->detach();
        $film->delete();

        return redirect()->route('films.admin.gestion')->with('success', 'Film supprimé');
    }


    public function create()
    {
        $genres = Genre::orderBy('libGenre')->get();
        $acteurs = Personne::join('participe', 'personne.idPer', '=', 'participe.idPer')
            ->where('participe.idRolePer', 1)
            ->select('personne.*')
            ->distinct()
            ->orderBy('nomPer')
            ->orderBy('prenomPer')
            ->get();

        $realisateurs = Personne::join('participe', 'personne.idPer', '=', 'participe.idPer')
            ->where('participe.idRolePer', 2)
            ->select('personne.*')
            ->distinct()
            ->orderBy('nomPer')
            ->orderBy('prenomPer')
            ->get();

        $scenaristes = Personne::join('participe', 'personne.idPer', '=', 'participe.idPer')
            ->where('participe.idRolePer', 3)
            ->select('personne.*')
            ->distinct()
            ->orderBy('nomPer')
            ->orderBy('prenomPer')
            ->get();


        return view('pages.ajout-film', compact('genres', 'acteurs', 'realisateurs', 'scenaristes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre'       => ['required', 'string', 'max:255'],
            'duree'       => ['required', 'string', 'max:50'],
            'synopsis'    => ['required', 'string'],
            'date_sortie' => ['required', 'date'],
//            'date_sortie' => ['required', 'date_format:d/m/Y'],

            'genres'      => ['required', 'array', 'min:1'],
            'genres.*'    => ['integer', 'exists:genre,idGenre'],

            'affiche'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ], [
            'titre.required' => 'Le titre est obligatoire.',
            'date_sortie.required' => 'La date de sortie est obligatoire.',
            'genres.required' => 'Veuillez sélectionner au moins un genre.',
            'genres.*.exists' => 'Un genre sélectionné est invalide.',
            'affiche.image' => 'Le fichier doit être une image.',
        ]);

        $genreId = (int) $validated['genres'][0];

        $imagePath = null;

        if ($request->hasFile('affiche')) {
            $file = $request->file('affiche');

            $filename = uniqid('film_', true) . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('images/'), $filename);

            $imagePath =  $filename;
        }

        $film = new Film();

        $film->titreFil = $validated['titre'];
        $film->dureFil = $validated['duree'] ?? null;
        $film->descFil = $validated['synopsis'] ?? null;
        $film->dateSortie = $validated['date_sortie'];
        $film->idGenre = $genreId;

        $film->imgFil = $imagePath;

        $film->save();

        $syncData = [];

        foreach ($request->input('acteurs', []) as $idPer) {
            if ($idPer) $syncData[$idPer] = ['idRolePer' => 1];
        }
        foreach ($request->input('realisateurs', []) as $idPer) {
            if ($idPer) $syncData[$idPer] = ['idRolePer' => 2];
        }
        foreach ($request->input('scenaristes', []) as $idPer) {
            if ($idPer) $syncData[$idPer] = ['idRolePer' => 3];
        }

        $film->personnes()->sync($syncData);

        return redirect()
            ->route('films.admin.gestion')
            ->with('success', 'Film ajouté avec succès.');
    }

    public function edit($id)
    {
        $film = Film::with(['acteursPrincipaux', 'realisateurs', 'scenaristes'])->find($id);
        $genres = Genre::all();
        $acteurs = Personne::join('participe', 'personne.idPer', '=', 'participe.idPer')
            ->where('participe.idRolePer', 2)
            ->select('personne.*')
            ->distinct()
            ->orderBy('nomPer')
            ->orderBy('prenomPer')
            ->get();

        $realisateurs = Personne::join('participe', 'personne.idPer', '=', 'participe.idPer')
            ->where('participe.idRolePer', 1)
            ->select('personne.*')
            ->distinct()
            ->orderBy('nomPer')
            ->orderBy('prenomPer')
            ->get();

        $scenaristes = Personne::join('participe', 'personne.idPer', '=', 'participe.idPer')
            ->where('participe.idRolePer', 3)
            ->select('personne.*')
            ->distinct()
            ->orderBy('nomPer')
            ->orderBy('prenomPer')
            ->get();
        return view('pages.edit-film', compact('film', 'genres', 'acteurs', 'realisateurs', 'scenaristes'));
    }


    public function update(Request $request, $id)
    {
        $film = Film::find($id);

        $validated = $request->validate([
            'titre'       => ['required', 'string', 'max:255'],
            'duree'       => ['nullable', 'string', 'max:50'],
            'synopsis'    => ['nullable', 'string'],
            'date_sortie' => ['required', 'date_format:d/m/Y'],

            'genres'      => ['required', 'array', 'min:1'],
            'genres.*'    => ['integer', 'exists:genre,idGenre'],

            'affiche'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $film->titreFil = $validated['titre'];
        $film->dureFil  = $validated['duree'] ?? null;
        $film->descFil  = $validated['synopsis'] ?? null;

        $film->dateSortie = Carbon::createFromFormat('d/m/Y', $validated['date_sortie'])->format('Y-m-d');

        $film->idGenre = (int) $validated['genres'][0];

        if ($request->hasFile('affiche')) {
            $file = $request->file('affiche');
            $filename = uniqid('film_', true) . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('images'), $filename);
            $film->imgFil = $filename;
        }

        $film->save();

        $syncData = [];

        foreach ($request->input('acteurs', []) as $idPer) {
            if ($idPer) $syncData[$idPer] = ['idRolePer' => 2];
        }
        foreach ($request->input('realisateurs', []) as $idPer) {
            if ($idPer) $syncData[$idPer] = ['idRolePer' => 1];
        }
        foreach ($request->input('scenaristes', []) as $idPer) {
            if ($idPer) $syncData[$idPer] = ['idRolePer' => 3];
        }

        $film->personnes()->sync($syncData);

        return redirect()
            ->route('films.admin.gestion')
            ->with('success', 'Film modifié avec succès.');
    }

    public function filmsAccueilAdmin()
    {
        $filmsAuCinema = Film::where('dateSortie', '<=', now())
            ->orderBy('dateSortie', 'desc')
            ->take(6)
            ->get();

        $filmsProchainement = Film::where('dateSortie', '>', now())
            ->orderBy('dateSortie', 'asc')
            ->take(6)
            ->get();

        return view('pages.accueil-admin', compact('filmsAuCinema', 'filmsProchainement'));
    }

    public function filmsAuCinemaAdmin(Request $request)
    {

        $genres = Genre::orderBy('libGenre')->get();
        $langues = Langue::all();
        $type_salles = TypeSalle::all();


        $selectedGenres = array_map('intval', $request->input('genres', []));

        $query = Film::query();

        if (!empty($selectedGenres)) {
            $query->whereIn('idGenre', $selectedGenres);
        }

        $films = $query->get();

        return view('pages.actuellement-au-cinema-admin', compact('films', 'genres', 'selectedGenres', 'langues', 'type_salles'));
    }

    public function ajoutProgramme(Request $request)
    {
        $genres = Genre::orderBy('libGenre')->get();
        $selectedGenres = array_map('intval', $request->input('genres', []));

        $query = Film::with('genre');

        if (!empty($selectedGenres)) {
            $query->whereIn('idGenre', $selectedGenres);
        }

        $films = $query->get();

        return view('pages.ajout-programme', compact('films', 'genres', 'selectedGenres'));
    }

    }

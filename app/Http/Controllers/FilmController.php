<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Langue;
use App\Models\TypeSalle;
use App\Models\TypeSeance;
use App\Models\Personne;
use Carbon\Carbon;
use App\Models\Participe;

class FilmController extends Controller
{
    //Contrôle pour afficher tous les films dans la page tous les films
    public function index(Request $request)
    {
        // Genres (pour afficher les boutons)
        $genres = Genre::orderBy('libGenre')->get();

        // Genres sélectionnés via l'URL: /films?genres[]=1&genres[]=3
        $selectedGenres = array_map('intval', $request->input('genres', []));
        // on récupère la saisie de l'utilisateur
        $recherche = $request->input('recherche');
        // Requête films
        $query = Film::query();
        // Appliquer le filtre genre si nécessaire
        if (!empty($selectedGenres)) {
            $query->whereIn('idGenre', $selectedGenres);
        }
        // Si la variable $recherche n'est pas vide (l'utilisateur a tapé un mot)
        if (!empty($recherche)) {
            // On cherche les films dont le titre ressemble au mot tapé
            // Le '%' de chaque côté permet de trouver le nom du film même si on tape juste quelque lettre
            $query->where('titreFil', 'LIKE', '%' . $recherche . '%');
        }

        $films = $query->get();

        if (auth()->check() && auth()->user()->role === 'admin') {
            return view('pages.Tous_films-admin', compact('films', 'genres', 'selectedGenres'));
        }

        return view('pages.Tous_films', compact('films', 'genres', 'selectedGenres'));
    }


    //Contrôle les films qui s'affiche dans la page d'accueil
    public function filmsAccueil(Request $request)
    {
        $recherche = $request->input('recherche');
        $filmsRecherche = null;

        if (!empty($recherche)) {
            $filmsRecherche = Film::where('titreFil', 'LIKE', '%' . $recherche . '%')->get();
        }


        $filmsAuCinema = Film::where('dateSortie', '<=', now())
            ->orderBy('titreFil', 'desc')
            ->take(6)
            ->get();

        $filmsProchainement = Film::where('dateSortie', '>', now())
            ->orderBy('titreFil', 'asc')
            ->take(6)
            ->get();

        if (auth()->check() && auth()->user()->role === 'admin') {
            return view('pages.accueil-admin', compact('filmsAuCinema', 'filmsProchainement', 'filmsRecherche', 'recherche'));
        }

        return view('pages.accueil', compact('filmsAuCinema', 'filmsProchainement', 'filmsRecherche', 'recherche'));
    }


    public function filmsAuCinema(Request $request)
    {
        $genres = Genre::orderBy('libGenre')->get();
        $type_salles = TypeSalle::all();
        $langues = Langue::all();

        $selectedGenres = array_map('intval', $request->input('genres', []));
        $recherche  = $request->input('rechercheCine');

        $query = Film::has('seances');

        if (!empty($selectedGenres)) {
            $query->whereIn('idGenre', $selectedGenres);
        }
        if (!empty($recherche)) {
            $query->where('titreFil', 'LIKE', '%' . $recherche . '%');
        }

        $films = $query->get();

        if (auth()->check() && auth()->user()->role === 'admin') {
            return view('pages.actuellement-au-cinema-admin', compact('films', 'genres', 'selectedGenres', 'type_salles', 'langues'));
        }
        return view('pages.actuellement-au-cinema', compact('films', 'genres', 'selectedGenres', 'type_salles', 'langues'));
    }

    public function show(Film $film)
    {
        $film->load('genre');

        if (auth()->check() && auth()->user()->role === 'admin') {
            return view('pages.film', compact('film'));
        }
        return view('pages.film', compact('film'));
    }

    // Méthode pour afficher le détail d'un acteur
    public function acteurdetail($id)
    {
        // On cherche dans la table personne la personne avec l'id passé dans l'URL
        // Si l'id n'existe pas en base, Laravel retourne automatiquement une erreur 404
        $acteur = Personne::findOrFail($id);

        // On envoie la personne trouvée à la vue personne-detail
        // 'role' permet à la vue de savoir qu'on affiche un acteur
        return view('pages.personne-detail', [
            'personne' => $acteur,
            'role'     => 'acteur',
        ]);
    }

// Méthode pour afficher le détail d'un réalisateur
    public function realisateurdetail($id)
    {
        // on cherche la personne par son id
        // findOrFail retourne la personne si elle existe, sinon 404
        $realisateur = Personne::findOrFail($id);

        // On envoie la personne à la vue avec le role 'realisateur'
        // pour que la vue sache comment l'afficher
        return view('pages.personne-detail', [
            'personne' => $realisateur,
            'role'     => 'realisateur',
        ]);
    }

}

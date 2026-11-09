<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineForAll - Accueil</title>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Header-style.css') }}">
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>

<body class="films-body">

@include('pages.header')

<div class="main-content">
    <!-- Barre de recherche -->
    <div class="search-section">
        <form action="{{ route('accueil') }}" method="GET" class="search-container">
            <img src="{{ asset('images/loupe.png') }}"
                 alt="Rechercher"
                 class="search-icon-img"
                 width="20"
                 height="20">
            <input type="text" name="recherche" placeholder="Rechercher un film" value="{{ $recherche ?? '' }}">
        </form>
    </div>

    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif

    <!-- Résultats de recherche -->
    @if(!empty($filmsRecherche))
        <div class="section">
            <div class="section-header">
                <h2 class="section-title">Résultats pour "{{ $recherche }}"</h2>
            </div>
            <div class="movies-grid-6">
                @forelse($filmsRecherche as $film)
                    <div class="movie-card">
                        <a href="{{ route('films.show', $film->idFil) }}" class="movie-poster-link">
                            <div class="movie-poster">
                                <img src="{{ asset('images/' . $film->imgFil) }}" alt="{{ $film->titreFil }}">
                            </div>
                        </a>
                        <div class="movie-title">{{ $film->titreFil }}</div>
                    </div>
                @empty
                    <p style="color: white;">Aucun film trouvé pour "{{ $recherche }}".</p>
                @endforelse
            </div>
        </div>
    @endif

</div>

<!-- Section Films au cinéma -->
<div class="section">
    <div class="section-header">
        <h2 class="section-title">Films au cinéma</h2>
        <a href="{{ route('films.cinema') }}" class="see-all-link">Tous les films actuellement au cinéma ›</a>
    </div>
    <div class="movies-grid-6">
        @if(isset($filmsAuCinema) && count($filmsAuCinema) > 0)
            @foreach($filmsAuCinema as $film)
                <div class="movie-card">
                    <a href="{{ route('films.show', $film->idFil) }}" class="movie-poster-link">
                        <div class="movie-poster">
                            <img src="{{ asset('images/' . $film->imgFil) }}" alt="{{ $film->titreFil }}">
                        </div>
                    </a>
                    <div class="movie-title">{{ $film->titreFil }}</div>
                </div>
            @endforeach
        @else
            <p style="color: white;">Aucun film trouvé dans la base de données.</p>
        @endif
    </div>
</div>

<!-- Section Prochaine sortie -->
<div class="section">
    <div class="section-header">
        <h2 class="section-title">Prochaine sortie</h2>
        <a href="#" class="see-all-link">Toutes les prochaines sorties ›</a>
    </div>
    <div class="movies-grid-6">
        @if(isset($filmsProchainement) && count($filmsProchainement) > 0)
            @foreach($filmsProchainement as $film)
                <div class="movie-card">
                    <a href="{{ route('films.show', $film->idFil) }}" class="movie-poster-link">
                        <div class="movie-poster">
                            <img src="{{ asset('images/' . $film->imgFil) }}" alt="{{ $film->titreFil }}">
                        </div>
                    </a>
                    <div class="movie-title">{{ $film->titreFil }}</div>
                </div>
            @endforeach
        @else
            <p style="color: white;">Aucun film trouvé dans la base de données.</p>
        @endif
    </div>
</div>

</body>
</html>

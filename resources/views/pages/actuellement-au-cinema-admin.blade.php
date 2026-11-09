<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films au cinéma - CineForAll</title>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <link rel="stylesheet" href="{{ asset('Header-style.css') }}">

</head>

<body class="films-body">
@include('pages.header-admin')

<div style="width: 100%;">
    <h1 class="page-title">Actuellement au cinéma</h1>

    <div class="search-section">
        <form action="{{ route('films.cinema') }}" method="GET" class="search-section" style="width: 100%; display: flex; align-items: center;">
            <div class="search-container" style="flex-grow: 1;">
                <img src="{{ asset('images/loupe.png') }}" width="35" height="35">
                <input type="text"
                       name="rechercheCine"
                       placeholder="Chercher un film..."
                       value="{{ request('rechercheCine') }}"
                       style="width: 100%; border: none; outline: none; background: transparent;">
            </div>

            <button class="filter-btn" id="openFilters" type="button">
                <span class="filter-icon">≡</span> Filtres
            </button>

            <button type="submit" style="display: none;"></button>
        </form>
        <!-- POPUP FILTRES (Actuellement au cinéma) -->
        <div class="filters-overlay" id="filtersOverlay" aria-hidden="true">
            <div class="filters-panel filters-panel--big" role="dialog" aria-modal="true" aria-labelledby="filtersTitle">

                <div class="filters-header">
                    <h2 class="filters-title" id="filtersTitle">Filtres</h2>
                    <button class="filters-close" id="closeFilters" type="button" aria-label="Fermer">✕</button>
                </div>

                <!-- VERSION -->
                <div class="filters-block">
                    <div class="filters-block-title">Version</div>
                    <div class="genre-pills">
                        @foreach($langues as $langue)
                            <button type="button" class="pill"
                                    data-filter="version"
                                    data-value="{{$langue->langSea}}">
                                {{$langue->langSea}}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- TYPE DE SALLE -->
                <div class="filters-block">
                    <div class="filters-block-title">Type de salle</div>
                    <div class="genre-pills">
                        @foreach($type_salles as $type_salle)
                            <button type="button" class="pill"
                                    data-filter="salle"
                                    data-value="{{ $type_salle->libTypSal }}">
                                {{ $type_salle->libTypSal }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- GENRE -->
                <div class="filters-block">
                    <div class="filters-block-title">Genre</div>
                    <div class="genre-pills">
                        @foreach($genres as $genre)
                            <button
                                type="button"
                                class="pill {{ in_array($genre->idGenre, $selectedGenres ?? []) ? 'pill-active' : '' }}"
                                data-genre-id="{{ $genre->idGenre }}"
                            >
                                {{ $genre->libGenre }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="filters-footer">
                    <button type="button" class="filters-reset" id="resetFilters">Réinitialiser</button>
                    <button type="button" class="filters-apply" id="applyFilters">Appliquer</button>
                </div>
            </div>
        </div>

    </div>

    <div class="movies-grid-6">
        @foreach($films as $film)
            <div class="movie-card">
                <a href="{{ route('films.show', $film->idFil) }}" class="movie-poster-link">
                    <div class="movie-poster">
                        <img src="{{ asset('images/' . $film->imgFil) }}" alt="{{ $film->titreFil }}">
                    </div>
                </a>
                <div class="movie-title">{{ $film->titreFil }}</div>
            </div>
        @endforeach
    </div>

</div>
@vite('resources/js/filtres_actuellement_cinema.js')
</body>
</html>


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
    <h1 class="page-title">Tous les films</h1>

    <div class="search-section">
        <div class="search-container">
            <img src="{{ asset('images/loupe.png') }}"
                 width="35"
                 height="35"
            >
            <input type="text" placeholder="Chercher un film">
        </div>
        <button class="filter-btn" id="openFilters" type="button">
            <span class="filter-icon">≡</span>
            Filtres
        </button>
    </div>
    <!-- POPUP FILTRES -->
    <div class="filters-overlay" id="filtersOverlay" aria-hidden="true">
        <div class="filters-panel" role="dialog" aria-modal="true" aria-labelledby="filtersTitle">
            <div class="filters-header">
                <h2 class="filters-title" id="filtersTitle">Filtres</h2>
                <button class="filters-close" id="closeFilters" type="button" aria-label="Fermer">✕</button>
            </div>

            <!-- GENRE -->
            <button class="filters-section-toggle" type="button" data-target="#genreSection" aria-expanded="true">
                Genre
                <span class="chev">▾</span>
            </button>

            <div class="filters-section" id="genreSection">
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

            <!-- ANNÉE -->
            <button class="filters-section-toggle" type="button" data-target="#yearSection" aria-expanded="false">
                Année de sortie
                <span class="chev">▾</span>
            </button>

            <div class="filters-section is-collapsed" id="yearSection">
                <div class="year-list">
                    <button type="button" class="year-item" data-year="2020-2029">
                        2020–2029 <span class="year-count">(21000)</span>
                    </button>
                    <button type="button" class="year-item" data-year="2010-2019">
                        2010–2019 <span class="year-count">(26000)</span>
                    </button>
                    <button type="button" class="year-item" data-year="2000-2009">
                        2000–2009 <span class="year-count">(23000)</span>
                    </button>
                    <button type="button" class="year-item" data-year="1990-1999">
                        1990–1999 <span class="year-count">(19000)</span>
                    </button>
                </div>
            </div>

            <div class="filters-footer">
                <button type="button" class="filters-reset" id="resetFilters">Réinitialiser</button>
                <button type="button" class="filters-apply" id="applyFilters">Appliquer</button>
            </div>
        </div>
    </div>

    <div class="movies-grid-6">
        @foreach($films as $film)
            <div class="movie-card">
                <a href="{{ route('films.admin.show', $film->idFil) }}" class="movie-poster-link">
                    <div class="movie-poster">
                        <img src="{{ asset('images/' . $film->imgFil) }}" alt="{{ $film->titreFil }}">
                    </div>
                </a>
                <div class="movie-title">{{ $film->titreFil }}</div>
            </div>
        @endforeach
    </div>
</div>
@vite('resources/js/filtres_tous_films.js')
</body>
</html>

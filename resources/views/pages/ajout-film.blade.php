<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ajouter un film</title>

    <link rel="stylesheet" href="{{ asset('styles.css') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
</head>
<body class="add-actor-body add-film-body">

@include('pages.header-admin')

<main class="add-actor-page add-film-page">
    <h1 class="add-actor-title add-film-title">Ajouter un film</h1>

    <form class="add-actor-form add-film-form" action="{{ route('film.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input
            type="text"
            name="titre"
            class="add-actor-input add-film-title-input"
            placeholder="Titre du film"
            required
        />

        <div class="add-film-layout">
            <!-- Colonne gauche -->
            <section class="add-film-main-col">
                <!-- Durée / Dates -->
                <div class="add-film-meta-grid">
                    <input
                        type="text"
                        name="duree"
                        class="add-actor-input add-film-meta-input"
                        placeholder="Durée en minutes"
                    />

                    <input
                        type="date"
                        name="date_sortie"
                        class="add-actor-input add-film-meta-input"
                        placeholder="Date de sortie"
                    />
                </div>

                <!-- Affiche + Synopsis -->
                <div class="add-film-content-grid">
                    <div>
                        <label for="affiche" class="add-film-poster-upload" aria-label="Ajouter une affiche">
                            <svg viewBox="0 0 64 64" class="add-film-poster-icon" aria-hidden="true">
                                <rect x="10" y="8" width="34" height="34" rx="3" ry="3" fill="none" stroke="currentColor" stroke-width="3"/>
                                <circle cx="22" cy="20" r="4" fill="currentColor"/>
                                <path d="M14 36l9-10 7 7 5-5 9 8" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M48 41v15" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                                <path d="M40.5 48.5H55.5" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                            </svg>
                        </label>
                        <p class="program-help">
                            Pour garantir une qualité visuelle optimale, l'équipe vous recommande d'utiliser les images de
                            <a href="https://www.themoviedb.org/?language=fr" target="_blank" style="color: #94a3b8; text-decoration: underline;">The Movie Database (TMDB)</a>.
                        </p>

                        <input
                            id="affiche"
                            type="file"
                            name="affiche"
                            class="add-film-file-input"
                            accept="image/*"
                        />
                    </div>

                    <textarea
                        name="synopsis"
                        class="add-actor-textarea add-film-synopsis"
                        placeholder="Synopsis"
                    ></textarea>
                </div>

                <!-- Genres -->
                <div class="add-film-genre-list">
                    @foreach($genres as $genre)
                        <label class="add-film-genre-pill">
                            <input
                                type="checkbox"
                                name="genres[]"
                                value="{{ $genre->idGenre }}"
                                class="add-film-genre-checkbox"
                                {{ in_array($genre->idGenre, old('genres', [])) ? 'checked' : '' }}
                            >
                            <span>{{ $genre->libGenre }}</span>
                        </label>
                    @endforeach
                </div>
            </section>

            <!-- Colonne droite -->
            <aside class="add-film-side-col">
                <div class="add-film-side-group">
                    <label class="add-film-side-label">Réalisateur</label>

                    <div class="add-film-side-list js-repeat-list" data-type="realisateurs">
                        <div class="add-film-side-row js-repeat-row">
                            <div class="add-film-select-wrap">
                                <select name="realisateurs[]" class="add-actor-input add-film-side-input add-film-side-input--removable">
                                    <option value="" selected disabled></option>
                                    @foreach($realisateurs as $p)
                                        <option value="{{ $p->idPer }}">{{ $p->prenomPer }} {{ $p->nomPer }}</option>
                                    @endforeach
                                </select>

                                <button type="button" class="add-film-inline-remove js-remove-row" aria-label="Retirer ce réalisateur">×</button>
                            </div>

                            <button type="button" class="add-film-mini-btn js-add-row" aria-label="Ajouter un réalisateur">+</button>
                        </div>
                    </div>

                    <a href="{{ route('realisateur.create') }}" class="add-film-side-link">
                        Ajouter un nouveau réalisateur
                    </a>
                </div>

                <div class="add-film-side-group">
                    <p class="add-film-side-label">Acteurs</p>

                    <div class="add-film-side-list js-repeat-list" data-type="acteurs">
                        <div class="add-film-side-row js-repeat-row">
                            <div class="add-film-select-wrap">
                                <select name="acteurs[]" class="add-actor-input add-film-side-input add-film-side-input--removable">
                                    <option value="" selected disabled></option>
                                    @foreach($acteurs as $p)
                                        <option value="{{ $p->idPer }}">{{ $p->prenomPer }} {{ $p->nomPer }}</option>
                                    @endforeach
                                </select>

                                <button type="button" class="add-film-inline-remove js-remove-row" aria-label="Retirer cet acteur">×</button>
                            </div>

                            <button type="button" class="add-film-mini-btn js-add-row" aria-label="Ajouter un acteur à la liste">+</button>
                        </div>
                    </div>

                    <a href="{{ route('acteur.create') }}" class="add-film-side-link">
                        Ajouter un nouvel acteur
                    </a>
                </div>

                <div class="add-film-side-group">
                    <label class="add-film-side-label">Scénariste</label>

                    <div class="add-film-side-list js-repeat-list" data-type="scenaristes">
                        <div class="add-film-side-row js-repeat-row">
                            <div class="add-film-select-wrap">
                                <select name="scenaristes[]" class="add-actor-input add-film-side-input add-film-side-input--removable">
                                    <option value="" selected disabled></option>
                                    @foreach($scenaristes as $p)
                                        <option value="{{ $p->idPer }}">{{ $p->prenomPer }} {{ $p->nomPer }}</option>
                                    @endforeach
                                </select>

                                <button type="button" class="add-film-inline-remove js-remove-row" aria-label="Retirer ce scénariste">×</button>
                            </div>

                            <button type="button" class="add-film-mini-btn js-add-row" aria-label="Ajouter un scénariste">+</button>
                        </div>
                    </div>

                    <a href="{{ route('scenariste.create') }}" class="add-film-side-link">
                        Ajouter un nouveau scénariste
                    </a>
                </div>
            </aside>
        </div>

        <div class="add-actor-actions add-film-actions">
            <button type="submit" class="add-actor-submit add-film-submit">Ajouter</button>
        </div>
    </form>
</main>
@vite('resources/js/ajout-personne.js')
</body>
</html>

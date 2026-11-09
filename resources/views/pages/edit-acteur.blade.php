{{--    <!DOCTYPE html>--}}
{{--    <html lang="fr">--}}
{{--    <head>--}}
{{--        <meta charset="UTF-8" />--}}
{{--        <meta name="viewport" content="width=device-width, initial-scale=1.0" />--}}
{{--        <title>Modifier un acteur</title>--}}

{{--        <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />--}}

{{--        <link rel="preconnect" href="https://fonts.googleapis.com">--}}
{{--        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>--}}
{{--        <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">--}}
{{--    </head>--}}
{{--    <body class="add-actor-body">--}}
{{--    @include('pages.header-admin')--}}
{{--    <main class="add-actor-page">--}}
{{--        <h1 class="add-actor-title">Modifier un acteur</h1>--}}

{{--        <form class="add-actor-form" action="{{ route('acteur.update', $acteur->idPer) }}" method="POST">--}}
{{--            @csrf--}}
{{--            @method('PUT')--}}

{{--            <div class="add-actor-grid">--}}
{{--                <input--}}
{{--                    type="text"--}}
{{--                    name="nomPer"--}}
{{--                    class="add-actor-input"--}}
{{--                    placeholder="Nom"--}}
{{--                    value="{{ $acteur->nomPer }}"--}}
{{--                    required--}}
{{--                />--}}

{{--                <input--}}
{{--                    type="text"--}}
{{--                    name="prenomPer"--}}
{{--                    class="add-actor-input"--}}
{{--                    placeholder="Prénom"--}}
{{--                    value="{{ $acteur->prenomPer }}"--}}
{{--                    required--}}
{{--                />--}}

{{--                <input--}}
{{--                    name="dateNaisPer"--}}
{{--                    class="add-actor-input"--}}
{{--                    placeholder="Date de naissance"--}}
{{--                    value="{{ $acteur->dateNaisPer }}"--}}
{{--                />--}}

{{--                <input--}}
{{--                    type="text"--}}
{{--                    name="lieuNaisPer"--}}
{{--                    class="add-actor-input"--}}
{{--                    placeholder="Lieu de naissance"--}}
{{--                    value="{{ $acteur->lieuNaisPer }}"--}}
{{--                />--}}
{{--            </div>--}}

{{--            <textarea--}}
{{--                name="bioPer"--}}
{{--                class="add-actor-textarea"--}}
{{--                placeholder="Biographie">{{ $acteur->bioPer }}--}}
{{--            </textarea>--}}

{{--            <div class="add-actor-actions">--}}
{{--                <button type="submit" class="add-actor-submit">Modifier</button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </main>--}}

{{--    </body>--}}
{{--    </html>--}}


    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modifier un acteur</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
</head>
<body class="add-actor-body">
@include('pages.header-admin')

<main class="add-actor-page">
    <h1 class="add-actor-title">Modifier un acteur</h1>

    <form class="add-actor-form" action="{{ route('acteur.update', $acteur->idPer) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="add-film-content-grid">
            <!-- Colonne gauche : image -->
            <div>
                <label for="affiche" class="add-film-poster-upload" aria-label="Modifier l'affiche">
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

            <!-- Colonne droite : infos acteur -->
            <div class="add-film-side-col">
                <input
                    type="text"
                    name="nomPer"
                    class="add-actor-input"
                    placeholder="Nom"
                    value="{{ $acteur->nomPer }}"
                    required
                />

                <input
                    type="text"
                    name="prenomPer"
                    class="add-actor-input"
                    placeholder="Prénom"
                    value="{{ $acteur->prenomPer }}"
                    required
                />

                <input
                    type="text"
                    name="lieuNaisPer"
                    class="add-actor-input"
                    placeholder="Lieu de naissance"
                    value="{{ $acteur->lieuNaisPer }}"
                    required
                />

                <input
                    type="date"
                    name="dateNaisPer"
                    class="add-actor-input"
                    value="{{ \Carbon\Carbon::parse($acteur->dateNaisPer)->format('Y-m-d') }}"
                    required
                />
            </div>
        </div>

        <textarea
            name="bioPer"
            class="add-actor-textarea"
            placeholder="Biographie"
        >{{ $acteur->bioPer }}</textarea>

        <div class="add-actor-actions">
            <button type="submit" class="add-actor-submit">Modifier</button>
        </div>
    </form>
</main>

</body>
</html>

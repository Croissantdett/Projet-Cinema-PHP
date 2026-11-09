<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineForAll - Gestion des films</title>

    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Tes CSS -->
    <link rel="stylesheet" href="{{ asset('Header-style.css') }}">
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>

<body class="films-body manage-films-body">

@include('pages.header-admin')

<main class="manage-films-content">
    <div class="manage-films-head">
        <h1 class="manage-films-title">Gestion des films</h1>

        <a href="{{ route('film.create') }}"
           class="manage-add-btn">
            Ajouter
        </a>
    </div>

    <!-- Liste des films -->
    <div class="manage-films-list">

        @forelse($films as $film)
            <article class="manage-film-row">

                <!-- Titre -->
                <div class="manage-film-col manage-film-name" title="{{ $film->titreFil }}">
                    {{ $film->titreFil }}
                </div>

                <!-- Date (adapte le nom du champ si besoin) -->
                <div class="manage-film-col manage-film-date">
                    {{ $film->dateSortie ? \Carbon\Carbon::parse($film->dateSortie)->format('d/m/Y') : 'Non renseignée' }}
                </div>

                <!-- Genre -->
                <div class="manage-film-col manage-film-genre">
                    {{ $film->genre->libGenre ?? 'Genre inconnu' }}
                </div>

                <!-- Durée (si ta durée est déjà formatée, remplace simplement par $film->dureeFil) -->
                <div class="manage-film-col manage-film-duration">
                    @if(!empty($film->dureFil))
                        {{ intdiv($film->dureFil, 60) }}h{{ str_pad($film->dureFil % 60, 2, '0', STR_PAD_LEFT) }}
                    @endif
                </div>

                <!-- Description / synopsis -->
                <div class="manage-film-col manage-film-description" title="{{ $film->synopsisFil }}">
                    {{ $film->descFil ?? 'Aucun synopsis disponible.' }}
                </div>

                <!-- Action modifier -->
                <a
                    href="{{ route('film.edit', $film->idFil) }}"
                   class="manage-action-btn"
                   aria-label="Modifier {{ $film->titreFil }}">
                    <i class="bi bi-pencil"></i>
                </a>

                <!-- Action supprimer -->
                <form action="{{ route('films.destroy', $film->idFil) }}" method="POST" class="manage-delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="manage-action-btn manage-action-btn--delete"
                            aria-label="Supprimer {{ $film->titreFil }}"
                            onclick="return confirm('Supprimer ce film ?')">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>

            </article>
        @empty
            <div class="manage-empty-state">
                Aucun film à afficher.
            </div>
        @endforelse

    </div>
</main>

</body>
</html>

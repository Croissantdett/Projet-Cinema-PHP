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
    <!-- Ligne titre + bouton -->
    <div class="manage-films-head">
        <h1 class="manage-films-title">Gestion des scénaristes</h1>

        <a
            href="{{ route('scenariste.create') }}"
            class="manage-add-btn">
            Ajouter
        </a>
    </div>

    <!-- Liste des films -->
    <div class="manage-films-list">

        @forelse($scenaristes as $personne)
            <article class="manage-acteur-row">

                <!-- Titre -->
                <div class="manage-film-col manage-film-name" title="{{ $personne->nomPer }}">
                    {{ $personne->nomPer }}
                </div>

                <div class="manage-film-col manage-film-name">
                    {{ $personne->prenomPer }}
                </div>

                <!-- Date -->
                <div class="manage-film-col manage-film-name">
                    {{ $personne->dateNaisPer ? \Carbon\Carbon::parse($personne->dateNaisPer)->format('d/m/Y') : 'Non renseignée' }}
                </div>

                <div class="manage-film-col manage-film-name">
                    {{ $personne->agePer }}
                </div>

                <div class="manage-film-col manage-film-name">
                    {{ $personne->lieuNaisPer }}
                </div>

                <div class="manage-film-col manage-acteur-name">
                    {{ $personne->bioPer }}
                </div>


                <!-- Action modifier -->
                <a
                    href="{{ route('scenariste.edit', $personne->idPer) }}"
                    class="manage-action-btn"
                    aria-label="Modifier {{ $personne->nomPer }}">
                    <i class="bi bi-pencil"></i>
                </a>

                <!-- Action supprimer -->
                <form
                    action="{{ route('scenariste.destroy', $personne->idPer) }}" method="POST" class="manage-delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="manage-action-btn manage-action-btn--delete"
                            aria-label="Supprimer {{ $personne->nomPer }}"
                            onclick="return confirm('Supprimer ce film ?')">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>

            </article>
        @empty
            <div class="manage-empty-state">
                Aucun acteur à afficher.
            </div>
        @endforelse
    </div>
</main>

</body>
</html>

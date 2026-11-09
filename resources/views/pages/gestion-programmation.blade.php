<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineForAll - Gestion des programmations</title>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('Header-style.css') }}">
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body class="films-body manage-films-body">

@include('pages.header-admin')

<main class="manage-films-content">
    <div class="manage-films-head">
        <h1 class="manage-films-title">Gestion des programmations</h1>
        <a href="{{ route('seance.create') }}" class="manage-add-btn">Ajouter</a>
    </div>

    <div class="manage-films-list">
        @forelse($seances as $seance)
            <article class="manage-film-row">

                <div class="manage-film-col manage-film-name" style="min-width:160px;">
                    {{ \Carbon\Carbon::parse($seance->dateHeurSea)->format('d/m/Y H:i') }}
                </div>

                <div class="manage-film-col manage-film-name" title="{{ $seance->film->titreFil ?? '' }}">
                    {{ $seance->film->titreFil ?? 'Film inconnu' }}
                </div>

                <div class="manage-film-col manage-film-name">
                    {{ $seance->salle->cinema->nomCin ?? 'Cinéma inconnu' }}
                    &mdash; Salle {{ $seance->salle->numSal ?? '?' }}
                </div>

                <div class="manage-film-col manage-film-name">
                    {{ $seance->typeSeance->libTypeSea ?? '-' }}
                </div>

                <div class="manage-film-col manage-film-name">
                    {{ $seance->langue->LangueSea ?? '-' }}
                </div>

                <a href="{{ route('seance.edit', $seance->idSea) }}"
                   class="manage-action-btn"
                   aria-label="Modifier la séance">
                    <i class="bi bi-pencil"></i>
                </a>

                <form action="{{ route('seance.destroy', $seance->idSea) }}" method="POST" class="manage-delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="manage-action-btn manage-action-btn--delete"
                            aria-label="Supprimer la séance"
                            onclick="return confirm('Supprimer cette séance ?')">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>

            </article>
        @empty
            <div class="manage-empty-state">Aucune séance à afficher.</div>
        @endforelse
    </div>
</main>

</body>
</html>

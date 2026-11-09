<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineForAll - Gestion des cinémas</title>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('Header-style.css') }}">
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body class="films-body manage-films-body">

@include('pages.header-admin')

<main class="manage-films-content">
    <div class="manage-films-head">
        <h1 class="manage-films-title">Gestion des cinémas</h1>
        <a href="{{ route('cinema.create') }}" class="manage-add-btn">Ajouter</a>
    </div>

    <div class="manage-films-list">
        @forelse($cinemas as $cinema)
            <article class="manage-film-row manage-cinema-row">

                <div class="manage-film-col manage-cinema-name" title="{{ $cinema->nomCin }}">
                    {{ $cinema->nomCin }}
                </div>

                <div class="manage-film-col manage-cinema-address" title="{{ $cinema->adrCin }}">
                    {{ $cinema->adrCin }}
                </div>

                <div class="manage-film-col manage-cinema-cp">
                    {{ $cinema->cpCin }}
                </div>

                <div class="manage-film-col manage-cinema-city">
                    {{ $cinema->vilCin }}
                </div>

                <a href="{{ route('cinema.edit', $cinema->idCin) }}"
                   class="manage-action-btn"
                   aria-label="Modifier {{ $cinema->nomCin }}">
                    <i class="bi bi-pencil"></i>
                </a>

                <form action="{{ route('cinema.destroy', $cinema->idCin) }}" method="POST" class="manage-delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="manage-action-btn manage-action-btn--delete"
                            aria-label="Supprimer {{ $cinema->nomCin }}"
                            onclick="return confirm('Supprimer ce cinéma ?')">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>

            </article>
        @empty
            <div class="manage-empty-state">
                Aucun cinéma à afficher.
            </div>
        @endforelse
    </div>
</main>

</body>
</html>

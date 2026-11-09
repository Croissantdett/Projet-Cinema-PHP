<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Détail film - {{ $film->titreFil }} - CineForAll</title>

    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <link rel="stylesheet" href="{{ asset('Header-style.css') }}">
</head>

<body class="film-detail-body">
@include('pages.header-admin')

<main class="film-detail-wrap">
    <section class="film-detail-card">

        <div class="film-detail-left">
            <div class="film-detail-poster">
                <img src="{{ asset('images/' . $film->imgFil) }}" alt="{{ $film->titreFil }}">
            </div>
            <a href="{{ route('film.edit', $film->idFil) }}" class="see-all-link">Gérer le film ›</a>
        </div>

        <div class="film-detail-right">
            <div class="film-detail-header">
                <h1 class="film-detail-title">{{ $film->titreFil }}</h1>

                @if(isset($film->noteFil))
                    <span class="film-detail-note">Note : {{ $film->noteFil }}</span>
                @endif
            </div>

            <div class="film-detail-meta">
                <p>
                    <span class="meta-label">Sortie :</span>
                    {{ $film->dateSortie ? \Carbon\Carbon::parse($film->dateSortie)->format('d/m/Y') : 'Non renseignée' }}
                </p>

                <p>
                    <span class="meta-label">{{ $film->genre->libGenre ?? 'Genre inconnu' }}</span>
                    @if(!empty($film->dureFil))
                        ({{ intdiv($film->dureFil, 60) }}h{{ str_pad($film->dureFil % 60, 2, '0', STR_PAD_LEFT) }})
                    @endif
                </p>
                <p><span class="meta-label">Réalisé par </span>
                    @forelse($film->realisateurs as $real)
                        <a href="{{ route('realisateur.show', $real->idPer) }}">
                            {{ $real->prenomPer }} {{ $real->nomPer }}</a>
                        {{ !$loop->last ? ', ' : '' }}
                    @empty
                        <em>Non renseigné</em>
                    @endforelse
                </p>
                <p><span class="meta-label">Avec </span>
                    @forelse($film->acteurs as $acteur)
                        <a href="{{ route('acteur.show', $acteur->idPer) }}">
                            {{ $acteur->prenomPer }} {{ $acteur->nomPer }}</a>
                        {{ !$loop->last ? ', ' : '' }}
                    @empty
                        <em>Non renseigné</em>
                    @endforelse
                </p>
            </div>

            <p class="film-detail-synopsis">
                {{ $film->descFil ?? 'Aucun synopsis disponible.' }}
            </p>
        </div>

    </section>
</main>

</body>
</html>

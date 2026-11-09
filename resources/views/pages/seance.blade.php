<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $cinema->nomCin }} - CineForAll</title>

    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <link rel="stylesheet" href="{{ asset('Header-style.css') }}">
    <link rel="stylesheet" href="{{ asset('cinema-style.css') }}">
</head>

<body class="cinema-body">
@if(auth()->check() && auth()->user()->role === 'admin')
    @include('pages.header-admin')
@else
    @include('pages.header')
@endif


<div class="main-content">

    <!-- Search + chips -->
    <div class="search-section cinema-search">
        <div class="search-container">
            <img src="{{ asset('images/loupe.png') }}"
                 width="35"
                 height="35"
            >
            <input type="text" value="{{ $cinema->nomCin }}" placeholder="Choisissez votre cinéma" />
        </div>

        @foreach($tousCinemas as $autre)
            <a class="cinema-chip" href="{{ route('seance.show', $autre->idCin) }}">
                <span class="cinema-chip-city">{{ $autre->vilCin }}</span>
                <span class="cinema-chip-name">{{ $autre->nomCin }}</span>
            </a>
        @endforeach
    </div>

    <!-- Header cinéma -->
    <div class="cinema-header">
        <h1 class="cinema-title">{{ strtoupper($cinema->nomCin) }}</h1>
        <p class="cinema-subtitle">{{ $cinema->vilCin }}</p>
        <button class="info-btn" type="button" id="openCinemaPopup">Informations utiles</button>
    </div>

    @if(session('success'))
        <script>
            alert("Réservation enregistrée !");
        </script>
    @endif

    <!-- Programme -->
    <div class="cinema-program">

        @forelse($films as $film)
            <!-- Film -->
            <div class="showtime-row">
                <div class="showtime-poster">
                    <img src="{{ asset('images/' . $film->imgFil) }}" alt="{{ $film->titreFil }}" />
                </div>

                <div class="showtime-content">
                    <div class="showtime-meta">
                        <h2 class="showtime-title">{{ $film->titreFil }}</h2>
                        <p class="showtime-genre">
                            {{ $film->genre->libGenre ?? '' }}
                            @if($film->dureFil)
                                ({{ intdiv($film->dureFil, 60) }}h{{ str_pad($film->dureFil % 60, 2, '0', STR_PAD_LEFT) }})
                            @endif
                            {{ $film->rolePer->nomPer ?? ''}}
                        </p>
                    </div>

                    <!-- Horaires sous le titre -->
                    <div class="showtime-times">
                        @foreach($film->seances as $seance)
                            @php
                                $debut  = \Carbon\Carbon::parse($seance->dateHeurSea);
                                $fin    = $debut->copy()->addMinutes($film->dureFil);
                                $typSal = $seance->salle->typeSalle->libTypSal ?? '';
                                $langue = $seance->typeSeance->libTypeSea ?? '';
                            @endphp
                            <form action="{{ route('reservation', $seance->idSea) }}" method="POST">
                                @csrf
                                <button type="submit" class="time-card">
                                <div class="time-card-top">
                                    <span class="time-badge">
                                        @if(in_array($typSal, ['IMAX', '4DX', 'Dolby Cinéma']))
                                            {{ $typSal }}
                                        @else
                                            &nbsp;
                                        @endif
                                    </span>
                                    <span class="time-lang">{{ $langue }}</span>
                                </div>
                                <div class="time-hour">{{ $debut->format('G\hi') }}</div>
                                <div class="time-end">(fin {{ $fin->format('G\hi') }})</div>
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <p>Aucune séance programmée pour ce cinéma.</p>
        @endforelse

        <!-- POPUP INFOS CINÉMA -->
        <div class="cinema-popup-overlay" id="cinemaPopupOverlay" aria-hidden="true">
            <div class="cinema-popup" role="dialog" aria-modal="true" aria-labelledby="cinemaPopupTitle">
                <button class="cinema-popup-close" type="button" id="cinemaPopupClose" aria-label="Fermer">✕</button>

                <h2 class="cinema-popup-title" id="cinemaPopupTitle">
                    A propos de<br>{{ $cinema->nomCin }}
                </h2>
                <p class="cinema-popup-subtitle">
                    {{ $cinema->adrCin }} – {{ $cinema->cpCin }}<br>{{ $cinema->vilCin }}
                </p>

                <div class="cinema-popup-badges">
                    <div class="cinema-popup-badge">
                        <div class="badge-number">{{ $cinema->salles->count() }}</div>
                        <div class="badge-label">SALLES</div>
                    </div>
                    @foreach($typesSalles as $typeSalle)
                        <div class="cinema-popup-badge">
                            <div class="badge-number">{{ strtoupper($typeSalle) }}</div>
                            <div class="badge-label">CINEMA</div>
                        </div>
                    @endforeach
                </div>

                <div class="cinema-popup-prices">
                    <h3 class="cinema-popup-section-title">Tarifs</h3>

                    @foreach($tarifs as $tarif)
                        <div class="price-row">
                            <span class="price-label">{{ $tarif->libTar }}</span>
                            <span class="price-value">{{ number_format($tarif->prixTar, 2, ',', '') }}€</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

</div>
@vite('resources/js/informations-utiles.js')
</body>
</html>

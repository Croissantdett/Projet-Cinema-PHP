<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ auth()->user()->username }} - CineForAll</title>

    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <link rel="stylesheet" href="{{ asset('Header-style.css') }}">
    <link rel="stylesheet" href="{{ asset('reservations.css') }}">
</head>

<body class="reservations-body">

@if(auth()->check() && auth()->user()->role === 'admin')
    @include('pages.header-admin')
@else
    @include('pages.header')
@endif

<div class="reservations-content">

    <h1 class="reservations-title">Mes réservations</h1>

    {{-- Réservations à venir --}}
    <div class="reservations-section">
        <h2 class="reservations-section-title">À venir</h2>

        @if($reservationsAVenir->isEmpty())
            <div class="reservations-empty">Aucune réservation à venir</div>
        @else
            <div class="reservations-grid">
                @foreach($reservationsAVenir as $reservation)
                    <div class="resa-card">
                        <span class="resa-badge">À VENIR</span>

                        <img
                            src="{{ asset('images/'.$reservation->seance->film->imgFil) }}"
                            alt="{{ $reservation->seance->film->titreFil }}"
                            class="resa-card-poster"
                        />

                        <div class="resa-card-body">
                            <div class="resa-card-title">
                                {{ $reservation->seance->film->titreFil }}
                            </div>

                            <div class="resa-card-meta">
                                <div class="resa-meta-item">
                                    <span class="resa-meta-dot"></span>
                                    {{ \Carbon\Carbon::parse($reservation->seance->dateHeurSea)->format('d/m/Y H:i') }}
                                </div>

                                <div class="resa-meta-item">
                                    <span class="resa-meta-dot"></span>
                                    Salle {{ $reservation->seance->salle->nomSal ?? 'N/A' }}
                                </div>

                                <div class="resa-meta-item">
                                    <span class="resa-meta-dot"></span>
                                    {{ $reservation->seance->langue->libLangue ?? '' }}
                                    &nbsp;·&nbsp;
                                    {{ $reservation->seance->typeSeance->libTypeSea ?? '' }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Réservations passées --}}
    <div class="reservations-section">
        <h2 class="reservations-section-title">Passées</h2>

        @if($reservationsPassees->isEmpty())
            <div class="reservations-empty">Aucune réservation passée</div>
        @else
            <div class="reservations-grid">
                @foreach($reservationsPassees as $reservation)
                    <div class="resa-card resa-card--past">

                        <img
                            src="{{ asset('images/'.$reservation->seance->film->imgFil) }}"
                            alt="{{ $reservation->seance->film->titreFil }}"
                            class="resa-card-poster"
                        />

                        <div class="resa-card-body">
                            <div class="resa-card-title">
                                {{ $reservation->seance->film->titreFil }}
                            </div>

                            <div class="resa-card-meta">
                                <div class="resa-meta-item">
                                    <span class="resa-meta-dot"></span>
                                    {{ \Carbon\Carbon::parse($reservation->seance->dateHeurSea)->format('d/m/Y H:i') }}
                                </div>

                                <div class="resa-meta-item">
                                    <span class="resa-meta-dot"></span>
                                    Salle {{ $reservation->seance->salle->nomSal ?? 'N/A' }}
                                </div>

                                <div class="resa-meta-item">
                                    <span class="resa-meta-dot"></span>
                                    {{ $reservation->seance->langue->libLangue ?? '' }}
                                    &nbsp;·&nbsp;
                                    {{ $reservation->seance->typeSeance->libTypeSea ?? '' }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

</body>
</html>

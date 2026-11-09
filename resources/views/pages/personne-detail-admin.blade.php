<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Détail {{ ucfirst($role ?? 'personne') }} - {{ $personne->prenomPer }} {{ $personne->nomPer }} - CineForAll</title>

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
                @php
                    $img = $personne->imgPer ?? null;
                    $age = $personne->dateNaisPer ? \Carbon\Carbon::parse($personne->dateNaisPer)->age : null;
                @endphp

                <img
                    src="{{ $img ? asset('images/' . $img) : asset('images/default-person.png') }}"
                    alt="{{ $personne->prenomPer }} {{ $personne->nomPer }}"
                >
            </div>

        </div>

        <div class="film-detail-right">
            <div class="film-detail-header">
                <h1 class="film-detail-title">
                    {{ $personne->prenomPer }} {{ $personne->nomPer }}
                </h1>

                {{--                @if(!empty($personne->agePer))--}}
                {{--                    <span class="film-detail-note">Âge : {{ $personne->agePer }} ans</span>--}}
                <span class="film-detail-note">{{ ucfirst($role ?? 'personne') }}</span>
                {{--                @endif--}}
            </div>

            <div class="film-detail-meta">
                <p>
                    <span class="meta-label">Date de naissance :</span>
                    {{ $personne->dateNaisPer ? \Carbon\Carbon::parse($personne->dateNaisPer)->format('d/m/Y') : 'Non renseignée' }}
                </p>

                <p>
                    <span class="meta-label">Lieu de naissance :</span>
                    {{ $personne->lieuNaisPer ?? 'Non renseigné' }}
                </p>

                <p>
                    {{--                    <span class="meta-label">Rôle :</span>--}}
                    {{--                    {{ ucfirst($role ?? 'personne') }}--}}
                    <span class="meta-label">Âge : </span> {{ $age !== null ? $age . ' ans' : 'Non renseigné' }}
                </p>
            </div>

            <p class="film-detail-synopsis">
                {{ $personne->bioPer ?? 'Aucune biographie disponible.' }}
            </p>
        </div>

    </section>
</main>

</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineForAll - Header</title>
    <link rel="stylesheet" href="{{ asset('Header-style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
</head>

<body>
<header>
    <div class="header-left">
        <a href="{{ route('accueil.admin') }}" class="logo">
            <img src="{{ asset('images/logo_CineForAll.png') }}"
                 width="80"
                 height="71">
        </a>

        <nav>
            <a href="{{ route('films.admin.cinema') }}">Films au cinéma</a>
            <a href="{{ route('seance') }}">Cinémas</a>
            <a href="{{ route('films.admin.index') }}">Tous les films</a>
            <div class="gestion-dropdown">
                <a href="{{ route('films.admin.gestion') }}" id="gestionLink" class="gestion-link">
                    Gestion des films
                </a>
                <div> </div>

                <div class="gestion-popup" id="gestionPopup">
                    <a href="{{ route('acteur.admin.gestion') }}">Acteur</a>
                    <a href="{{ route('realisateur.admin.gestion') }}">Réalisateur</a>
                    <a href="{{ route('scenariste.admin.gestion') }}">Scénariste</a>
                    <a href="{{ route('cinema.admin.gestion') }}">Cinéma</a>
                    <a href="{{ route('seance.admin.gestion') }}">Programmation</a>
                </div>
            </div>
        </nav>
    </div>

    <div class="header-right">
        <button class="icon-btn search-icon" aria-label="Rechercher">
            <img src="{{ asset('images/loupe.png') }}"
                 width="45"
                 height="45"
            >
        </button>
        <button class="icon-btn user-icon" id="userBtn" aria-label="Profil utilisateur">
            <img src="{{ asset('images/utilisateur.png') }}"
                 width="40"
                 height="40"
            >

        </button>
    </div>
</header>
<div class="popup-overlay" id="popupOverlay">
    <div class="popup">
        @auth
            <h2>Mon compte</h2>
            <form method="POST" action="{{ route('logout') }}" style="margin-top:10px;">
                @csrf
                <button type="submit" class="popup-btn btn-logout">
                    Se déconnecter
                </button>
            </form>
        @endauth
    </div>
</div>
<script>
    window.routes = {
        recherche: "{{ route('recherche') }}"
    };
</script>
@vite('resources/js/popup-gestion.js')
@vite('resources/js/popup_connexion.js')
@vite('resources/js/loupe-recherche.js')
</body>
</html>

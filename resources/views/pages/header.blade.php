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
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/logo_CineForAll.png') }}"
                 width="80"
                 height="71">
        </a>

        <nav>
            <a href="{{ route('films.cinema') }}">Films au cinéma</a>
            <a href="{{ route('seance') }}">Cinémas</a>
            <a href="{{ route('films.index') }}">Tous les films</a>
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
        @guest
            <h2>Mon compte</h2>
            <button class="popup-btn btn-login" onclick="window.location.href='{{ route('connexion') }}'">Se connecter</button>
            <button class="popup-btn btn-signup"  onclick="window.location.href='{{ route('inscription') }}'">S'inscrire</button>
        @endguest
            @auth
                <form style="margin-top:10px;" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="popup-btn btn-logout" type="submit">
                        Se déconnecter
                    </button>
                </form>
                <button class="popup-btn btn-signup" onclick="window.location.href='{{ route('pages.mes-reservations') }}'">
                    Mes réservations
                </button>
            @endauth
    </div>
</div>
<script>
    window.routes = {
        recherche: "{{ route('recherche') }}"
    };
</script>
@vite('resources/js/popup_connexion.js')
@vite('resources/js/loupe-recherche.js')
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineForAll - Connexion</title>
    <link rel="stylesheet" href="{{ asset('Connexion_style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
</head>

<body>
<div class="container">

    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif

    <!-- GAUCHE : logo + récap séance -->
    <div class="logo-section booking-section">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/logo_CineForAll.png') }}" alt="CineForAll">
        </a>

        @if($seance)
        <div class="booking-card">
            <div class="booking-poster">
                <img src="{{asset('images/'.$seance->film->imgFil)}}">
            </div>

            <div class="booking-info">
                <p><strong>Film :</strong> {{$seance->film->titreFil}} <span class="booking-badge"> {{$seance->typeSeance->libTypeSea}} </span></p>
                <p><strong>Salle :</strong> {{$seance->salle->numSal}} </p>
                <p><strong>Horaire :</strong> {{\Carbon\Carbon::parse($seance->dateHeurSea)->format('H\hi - d/m')}} </p>
            </div>
        </div>
        @endif
    </div>


    <!-- DROITE : formulaire -->
    <div class="form-section">
        <div class="form-card">
            <h1>Connexion</h1>

            <form method="POST" action="{{ route('login_reservationPOST') }}">
                @csrf
                <div class="form-group">
                    <label for="username">Nom d'utilisateur:</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div>
                    <input type="checkbox" name="remember"> Se souvenir de moi
                </div>

                <button type="submit" class="submit-btn">Se connecter</button>
            </form>

            <div class="login-link">
                Pas encore inscrit ? <a href="{{ route('inscription_reservation', ['seance' => $seance->idSea ?? null]) }}">S'inscrire ici</a>
            </div>
        </div>
    </div>

</div>
</body>
</html>

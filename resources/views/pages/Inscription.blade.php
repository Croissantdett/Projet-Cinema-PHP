<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineForAll - Inscription</title>
    <link rel="stylesheet" href="{{ asset('Connexion_style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
    <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo_CineForAll.png') }}"
                 width="289.5"
                 height="260.5">
    </a>

    <div class="form-section">
        <div class="form-card">
            <h1>Inscription</h1>

            <form method="POST" action="{{ route('sign_in') }}">
            @csrf
                <div class="form-group">
                    <label for="username">Nom d'utilisateur:</label>
                    <input type="text" id="username" name="username" required  class="@error('username') input-error @enderror">

                    @error('username')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe:</label>
                    <input type="password" id="password" name="password" required class="@error('password') input-error @enderror">

                    @error('password')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div>
                    <input type="checkbox" name="remember"> Se souvenir de moi
                </div>

                <button type="submit" class="submit-btn">S'inscrire</button>
            </form>

            <div class="login-link">
                Déjà inscrit ? <a href="/connexion">Se connecter ici</a>
            </div>
        </div>
    </div>

</div>

</body>
</html>

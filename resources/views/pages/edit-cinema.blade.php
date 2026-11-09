<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modifier un cinéma</title>
    <link rel="stylesheet" href="/styles.css" />
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
</head>
<body class="add-actor-body">

@include('pages.header-admin')

<main class="add-actor-page">
    <h1 class="add-actor-title">Modifier un cinéma</h1>

    <form class="add-actor-form" action="{{ route('cinema.update', $cinema->idCin) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="add-actor-grid">
            <input
                type="text"
                name="nomCin"
                class="add-actor-input"
                placeholder="Nom"
                value="{{ $cinema->nomCin }}"
                required
            />

            <input
                type="text"
                name="AdrCin"
                class="add-actor-input"
                placeholder="Adresse"
                value="{{ $cinema->AdrCin }}"
                required
            />

            <input
                type="text"
                name="cpCin"
                class="add-actor-input"
                placeholder="Code postal"
                value="{{ $cinema->cpCin }}"
            />

            <input
                type="text"
                name="vilCin"
                class="add-actor-input"
                placeholder="Ville"
                value="{{ $cinema->vilCin }}"
            />
        </div>

        <div class="add-actor-actions">
            <button type="submit" class="add-actor-submit">Enregistrer</button>
        </div>
    </form>
</main>

</body>
</html>

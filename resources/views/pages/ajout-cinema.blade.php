<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ajouter un cinéma</title>

    <link rel="stylesheet" href="{{ asset('styles.css') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
</head>
<body class="add-actor-body">

@include('pages.header-admin')

<main class="add-actor-page">
    <h1 class="add-actor-title">Ajouter un cinéma</h1>

    <form class="add-actor-form" action="{{ route('cinema.store') }}" method="POST">
        @csrf

        <div class="add-actor-grid">
            <input
                type="text"
                name="nomCin"
                class="add-actor-input"
                placeholder="Nom"
                required
            />

            <input
                type="text"
                name="AdrCin"
                class="add-actor-input"
                placeholder="Adresse"
                required
            />

            <input
                type="text"
                name="cpCin"
                class="add-actor-input"
                placeholder="Code postal"
            />

            <input
                type="text"
                name="vilCin"
                class="add-actor-input"
                placeholder="Ville"
            />
        </div>

        <div class="add-actor-actions">
            <button type="submit" class="add-actor-submit">Ajouter</button>
        </div>
    </form>
</main>

</body>
</html>

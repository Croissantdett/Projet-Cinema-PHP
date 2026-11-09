<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ajouter une séance</title>
    <link rel="stylesheet" href="/styles.css" />
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <style>
        .seance-form-select {
            width: 100%;
            padding: 10px 14px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            background: #fff;
            color: #333;
            box-sizing: border-box;
        }
        .seance-form-select:focus { outline: none; border-color: #e50914; }
    </style>
</head>
<body class="add-actor-body">

@include('pages.header-admin')

<main class="add-actor-page">
    <h1 class="add-actor-title">Ajouter une séance</h1>

    @if($errors->any())
        <div style="background:#f8d7da;color:#721c24;padding:10px 16px;border-radius:6px;margin-bottom:16px;">
            <ul style="margin:0;padding-left:16px;">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form class="add-actor-form" action="{{ route('seance.store') }}" method="POST">
        @csrf

        <div class="add-actor-grid">

            <div>
                <label style="display:block;margin-bottom:4px;font-weight:600;">Date et heure</label>
                <input type="datetime-local" name="dateHeurSea" class="add-actor-input"
                       value="{{ old('dateHeurSea') }}" required />
            </div>

            <div>
                <label style="display:block;margin-bottom:4px;font-weight:600;">Film</label>
                <select name="idFil" class="seance-form-select" required>
                    <option value="">-- Sélectionner un film --</option>
                    @foreach($films as $film)
                        <option value="{{ $film->idFil }}" {{ old('idFil') == $film->idFil ? 'selected' : '' }}>
                            {{ $film->titreFil }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label style="display:block;margin-bottom:4px;font-weight:600;">Cinéma (filtre)</label>
                <select id="cinema-filter" class="seance-form-select">
                    <option value="">-- Tous les cinémas --</option>
                    @foreach($cinemas as $cinema)
                        <option value="{{ $cinema->idCin }}">{{ $cinema->nomCin }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label style="display:block;margin-bottom:4px;font-weight:600;">Salle</label>
                <select name="idSal" id="salle-select" class="seance-form-select" required>
                    <option value="">-- Sélectionner une salle --</option>
                    @foreach($salles as $salle)
                        <option value="{{ $salle->idSal }}"
                                data-cinema="{{ $salle->idCin }}"
                            {{ old('idSal') == $salle->idSal ? 'selected' : '' }}>
                            {{ $salle->cinema->nomCin ?? '' }} — Salle {{ $salle->numSal }} ({{ $salle->nbPlace }} places)
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label style="display:block;margin-bottom:4px;font-weight:600;">Type de séance</label>
                <select name="idTypeSea" class="seance-form-select" required>
                    <option value="">-- Sélectionner un type --</option>
                    @foreach($typesSeance as $type)
                        <option value="{{ $type->idTypeSea }}" {{ old('idTypeSea') == $type->idTypeSea ? 'selected' : '' }}>
                            {{ $type->libTypeSea }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label style="display:block;margin-bottom:4px;font-weight:600;">Langue</label>
                <select name="idLangue" class="seance-form-select" required>
                    <option value="">-- Sélectionner une langue --</option>
                    @foreach($langues as $langue)
                        <option value="{{ $langue->idLangue }}" {{ old('idLangue') == $langue->idLangue ? 'selected' : '' }}>
                            {{ $langue->LangueSea }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="add-actor-actions">
            <button type="submit" class="add-actor-submit">Ajouter</button>
        </div>
    </form>
</main>

<script>
    document.getElementById('cinema-filter').addEventListener('change', function () {
        const selected = this.value;
        document.querySelectorAll('#salle-select option[data-cinema]').forEach(opt => {
            if (!selected || opt.dataset.cinema === selected) {
                opt.style.display = '';
            } else {
                opt.style.display = 'none';
                if (opt.selected) document.getElementById('salle-select').value = '';
            }
        });
    });
</script>

</body>
</html>

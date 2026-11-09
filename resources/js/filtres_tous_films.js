document.addEventListener('DOMContentLoaded', function () {
    // Attend que toute la page HTML soit complètement chargée avant de lancer le script

    const openBtn = document.getElementById('openFilters');
    // Récupère le bouton qui sert à ouvrir les filtres

    const overlay = document.getElementById('filtersOverlay');
    // Récupère la grande zone qui contient le fond gris + le panneau de filtres

    const closeBtn = document.getElementById('closeFilters');
    // Récupère le bouton qui permet de fermer le panneau

    if (!openBtn || !overlay || !closeBtn) return;
    // Sécurité : si un des éléments n’existe pas sur la page, on arrête le script

    const open = () => {
        // Fonction qui ouvre le panneau des filtres

        overlay.classList.add('active');
        // Ajoute la classe "active" pour rendre le panneau visible

    };

    const close = () => {
        // Fonction qui ferme le panneau des filtres

        overlay.classList.remove('active');
        // Retire la classe "active" pour masquer le panneau

    };

    openBtn.addEventListener('click', open);
    // Quand on clique sur le bouton d’ouverture, on affiche le panneau

    closeBtn.addEventListener('click', close);
    // Quand on clique sur le bouton de fermeture, on masque le panneau

    overlay.addEventListener('click', (e) => {
        // Écoute les clics dans toute la zone de l’overlay

        if (e.target === overlay) close();
        // Vérifie si on a cliqué sur le fond
        // Si oui, ferme le popup
    });

    document.querySelectorAll('.filters-section-toggle').forEach((btn) => {
        // Récupère tous les boutons qui servent à ouvrir ou fermer une section

        btn.addEventListener('click', () => {
            // Quand on clique sur un bouton d’accordéon

            const targetSel = btn.getAttribute('data-target');
            // Récupère le sélecteur de la section liée à ce bouton

            const section = document.querySelector(targetSel);
            // Récupère la section à ouvrir ou fermer

            if (!section) return;
            // Sécurité : si la section n’existe pas, on arrête

            const isCollapsed = section.classList.contains('is-collapsed');
            // Vérifie si la section est actuellement fermée

            section.classList.toggle('is-collapsed', !isCollapsed);
            // Ouvre ou ferme la section

            btn.setAttribute('aria-expanded', isCollapsed ? 'true' : 'false');
            // Met à jour l’attribut d’accessibilité pour indiquer si la section est ouverte ou fermée

            const chev = btn.querySelector('.chev');
            // Récupère la petite flèche affichée dans le bouton

            if (chev) chev.textContent = isCollapsed ? '▾' : '▸';
            // Change la flèche selon l’état de la section
        });
    });

    document.querySelectorAll('.pill').forEach((pill) => {
        // Récupère toutes les pastilles de genre

        pill.addEventListener('click', () => {
            // Quand on clique sur une pastille

            pill.classList.toggle('pill-active');
            // Ajoute ou retire la classe "pill-active" pour sélectionner ou désélectionner la pastille
        });
    });

    document.querySelectorAll('.year-item').forEach((item) => {
        // Récupère toutes les options d’année

        item.addEventListener('click', () => {
            // Quand on clique sur une année

            document.querySelectorAll('.year-item').forEach(i => i.classList.remove('pill-active'));
            // Retire la classe active sur toutes les années

            item.classList.add('pill-active');
            // Active uniquement l’année sur laquelle on vient de cliquer
        });
    });

    document.getElementById('resetFilters')?.addEventListener('click', () => {
        // Écoute le clic sur le bouton "Réinitialiser" s’il existe

        document.querySelectorAll('.pill').forEach(p => p.classList.remove('pill-active'));
        // Désactive toutes les pastilles de genre

        document.querySelectorAll('.year-item').forEach(i => i.classList.remove('pill-active'));
        // Désactive aussi l’année sélectionnée
    });

    document.getElementById('applyFilters')?.addEventListener('click', () => {
        // Écoute le clic sur le bouton "Appliquer" s’il existe

        const params = new URLSearchParams();
        // Crée un objet qui permet de construire les paramètres de l’URL

        document.querySelectorAll('.pill.pill-active').forEach(p => {
            // Récupère toutes les pastilles de genre sélectionnées

            const id = p.dataset.genreId;
            // Récupère l’identifiant du genre stocké dans l’attribut data-genre-id

            if (id) params.append('genres[]', id);
            // Ajoute l’id du genre dans l’URL s’il existe
        });

        const searchInput = document.getElementById('searchBar');
        // Récupère la barre de recherche

        const searchValue = searchInput.value.trim();
        // Récupère le texte saisi sans les espaces inutiles au début et à la fin

        if (searchValue !== '') {
            params.set('recherche', searchValue);
            // Ajoute la recherche dans l’URL si un texte a été saisi
        }

        const year = document.querySelector('.year-item.pill-active');
        // Récupère l’année actuellement sélectionnée

        if (year) params.set('year', year.dataset.year);
        // Ajoute l’année dans l’URL si une année est sélectionnée

        const url = new URL(window.location.href);

        url.search = params.toString();

        window.location.href = url.toString();
        // Redirige vers la page avec les filtres choisis

        close();
        // Ferme le panneau des filtres
    });

    const searchBar = document.getElementById('searchBar');

    if (searchBar) {

        searchBar.addEventListener('keydown', function (e) {

            if (e.key === 'Enter') {

                const value = searchBar.value.trim();

                const url = new URL(window.location.href);

                if (value !== '') {
                    url.searchParams.set('recherche', value);
                } else {
                    url.searchParams.delete('recherche');
                }

                window.location.href = url.toString();
            }

        });

    }

});

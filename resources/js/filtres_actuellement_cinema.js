document.addEventListener('DOMContentLoaded', function () {
    // Attend que toute la page HTML soit complètement chargée avant de lancer le script

    const openBtn = document.getElementById('openFilters');
    // Récupère le bouton qui sert à ouvrir la fenêtre des filtres

    const overlay = document.getElementById('filtersOverlay');
    // Récupère la grande zone qui contient le fond gris + la fenêtre des filtres

    const closeBtn = document.getElementById('closeFilters');
    // Récupère le bouton qui permet de fermer la fenêtre des filtres

    if (!openBtn || !overlay || !closeBtn) return;
    // Sécurité : si un des éléments n’existe pas sur la page, on arrête le script

    const open = () => {
        // Fonction qui ouvre la fenêtre des filtres

        overlay.classList.add('active');
        // Ajoute la classe "active" pour rendre la fenêtre visible

    };

    const close = () => {
        // Fonction qui ferme la fenêtre des filtres

        overlay.classList.remove('active');
        // Retire la classe "active" pour masquer la fenêtre

    };

    openBtn.onclick = open;
    // Quand on clique sur le bouton "Filtres", on ouvre la fenêtre

    closeBtn.onclick = close;
    // Quand on clique sur le bouton de fermeture, on ferme la fenêtre

    overlay.onclick = function (e) {
        // Écoute les clics dans toute la zone de l’overlay

        if (e.target === overlay) {
            // Vérifie si on a cliqué exactement sur le fond gris, et pas sur la fenêtre elle-même

            close();
            // Si oui, ferme la fenêtre
        }
    };

    overlay.querySelectorAll('.pill').forEach(function (pill) {
        // Récupère toutes les pastilles de filtres présentes dans la fenêtre

        pill.onclick = function () {
            // Quand on clique sur une pastille

            pill.classList.toggle('pill-active');
            // Ajoute ou retire la classe "pill-active" pour sélectionner ou désélectionner la pastille
        };
    });

    document.getElementById('resetFilters')?.addEventListener('click', function () {
        // Écoute le clic sur le bouton "Réinitialiser" s’il existe

        overlay.querySelectorAll('.pill').forEach(function (pill) {
            // Parcourt toutes les pastilles de filtres

            pill.classList.remove('pill-active');
            // Retire la classe "pill-active" pour tout désélectionner
        });
    });

    document.getElementById('applyFilters')?.addEventListener('click', function () {
        // Écoute le clic sur le bouton "Appliquer" s’il existe

        const params = new URLSearchParams();
        // Crée un objet qui permet de construire les paramètres de l’URL

        overlay.querySelectorAll('.pill.pill-active').forEach(function (p) {
            // Récupère uniquement les pastilles actuellement sélectionnées

            const id = p.dataset.genreId;
            // Récupère l’identifiant du genre stocké dans l’attribut data-genre-id

            if (id) params.append('genres[]', id);
            // Ajoute l’id du genre dans l’URL s’il existe
        });

        const url = new URL(window.location.href);

        url.search = params.toString();

        window.location.href = url.toString();
        // Redirige vers la page avec les genres sélectionnés dans l’URL

        close();
        // Ferme la fenêtre des filtres
    });
});

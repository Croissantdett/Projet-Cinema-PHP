document.addEventListener('DOMContentLoaded', () => {
    // Attend que toute la page HTML soit complètement chargée avant de commencer

    const openBtn = document.getElementById('openCinemaPopup');
    // Récupère le bouton qui sert à ouvrir la popup cinéma

    const overlay = document.getElementById('cinemaPopupOverlay');
    // Récupère la grande zone qui contient le fond + la popup cinéma

    const closeBtn = document.getElementById('cinemaPopupClose');
    // Récupère le bouton qui permet de fermer la popup

    if (!openBtn || !overlay || !closeBtn) return;
    // Sécurité : si un des éléments n'existe pas sur la page, on arrête le script

    const open = () => {
        // Fonction qui ouvre la popup cinéma

        overlay.classList.add('active');
        // Ajoute la classe "active" → la popup devient visible grâce au CSS

        overlay.setAttribute('aria-hidden', 'false');
        // Accessibilité : indique que la popup est visible pour les lecteurs d’écran
    };

    const close = () => {
        // Fonction qui ferme la popup cinéma

        overlay.classList.remove('active');
        // Retire la classe "active" → la popup est masquée

        overlay.setAttribute('aria-hidden', 'true');
        // Accessibilité : indique que la popup est cachée pour les lecteurs d’écran
    };

    openBtn.addEventListener('click', open);
    // Quand on clique sur le bouton d’ouverture → on exécute la fonction open()

    closeBtn.addEventListener('click', close);
    // Quand on clique sur le bouton de fermeture → on exécute la fonction close()

    overlay.addEventListener('click', (e) => {
        // Quand on clique quelque part dans la zone de l’overlay

        if (e.target === overlay) close();
        // On vérifie si on a cliqué exactement sur le fond
        // Si oui → on ferme la popup
    });

});

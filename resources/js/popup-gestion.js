document.addEventListener('DOMContentLoaded', () => {
    // Attend que toute la page HTML soit complètement chargée avant de commencer

    const gestionBtn = document.getElementById('gestionBtn');
    // Récupère le bouton "Gestion des films" dans le header

    const gestionPopup = document.getElementById('gestionPopup');
    // Récupère le menu popup qui contient Acteur / Réalisateur / etc.

    if (!gestionBtn || !gestionPopup) return;
    // Sécurité : si l'un des deux éléments n'existe pas sur la page → on arrête tout de suite

    document.addEventListener('click', () => {
        // Quand on clique n'importe où ailleurs sur la page

        gestionPopup.classList.remove('active');
        // On enlève la classe "active" → le popup disparaît
    });

});

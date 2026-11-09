document.addEventListener('DOMContentLoaded', () => {
    // Attend que toute la page HTML soit complètement chargée avant de commencer

    const userBtn = document.getElementById('userBtn');
    // Récupère le bouton qui ouvre le menu utilisateur (icône ou nom de l'utilisateur)

    const popupOverlay = document.getElementById('popupOverlay');
    // Récupère la grande zone qui contient le fond gris + le vrai menu popup

    if (!userBtn || !popupOverlay) return;
    // Sécurité : si l'un des deux éléments n'existe pas sur la page, on arrête tout de suite

    userBtn.addEventListener('click', () => {
        // Quand on clique sur le bouton utilisateur
        popupOverlay.classList.add('active');
        // On ajoute la classe "active" → le popup devient visible (grâce au CSS)
    });

    popupOverlay.addEventListener('click', (e) => {
        // Quand on clique n'importe où dans la zone du popup (fond + menu)
        if (e.target === popupOverlay) {
            // On vérifie si on a cliqué exactement sur le fond (pas sur le menu à l'intérieur)
            popupOverlay.classList.remove('active');
            // Si oui → on enlève la classe "active" → le popup disparaît
        }
    });

});

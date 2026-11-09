document.addEventListener('DOMContentLoaded', function () {
    // Attend que toute la page HTML soit complètement chargée avant de lancer le script

    function resetRow(row) {
        // Fonction qui remet à zéro les champs d’une ligne clonée

        row.querySelectorAll('select').forEach(function (select) {
            // Récupère tous les menus déroulants de cette ligne

            select.selectedIndex = 0;
            // Remet chaque menu sur sa première option
        });

        row.querySelectorAll('input').forEach(function (input) {
            // Récupère tous les champs input de cette ligne

            if (input.type !== 'button' && input.type !== 'submit' && input.type !== 'hidden') {
                // Vérifie que l’input n’est pas un bouton, un bouton d’envoi ou un champ caché

                input.value = '';
                // Vide le contenu du champ
            }
        });
    }

    document.addEventListener('click', function (event) {
        // Écoute tous les clics effectués sur la page
        // Cela permet aussi de gérer les lignes ajoutées après le chargement

        const addBtn = event.target.closest('.js-add-row');
        // Vérifie si le clic a eu lieu sur un bouton d’ajout

        if (addBtn) {
            // Si on a cliqué sur le bouton "+" :

            const currentRow = addBtn.closest('.js-repeat-row');
            // Récupère la ligne actuelle dans laquelle se trouve le bouton

            const list = addBtn.closest('.js-repeat-list');
            // Récupère le bloc qui contient toutes les lignes

            if (!currentRow || !list) return;
            // Sécurité : si la ligne ou la liste n’existe pas, on arrête le script

            const newRow = currentRow.cloneNode(true);
            // Crée une copie complète de la ligne actuelle

            resetRow(newRow);
            // Remet à zéro les champs de la nouvelle ligne

            currentRow.insertAdjacentElement('afterend', newRow);
            // Insère la nouvelle ligne juste en dessous de la ligne actuelle

            return;
            // Arrête ici l’exécution car l’ajout est terminé
        }

        const removeBtn = event.target.closest('.js-remove-row');
        // Vérifie si le clic a eu lieu sur un bouton de suppression

        if (removeBtn) {
            // Si on a cliqué sur le bouton "×" :

            const row = removeBtn.closest('.js-repeat-row');
            // Récupère la ligne à supprimer

            const list = removeBtn.closest('.js-repeat-list');
            // Récupère le bloc qui contient toutes les lignes

            if (!row || !list) return;
            // Sécurité : si la ligne ou la liste n’existe pas, on arrête le script

            const rows = list.querySelectorAll('.js-repeat-row');
            // Récupère toutes les lignes présentes dans la liste

            if (rows.length <= 1) {
                // Vérifie s’il ne reste qu’une seule ligne
                // Si oui, on ne la supprime pas pour garder au moins une ligne affichée

                row.querySelectorAll('select').forEach(function (select) {
                    // Récupère tous les menus déroulants de cette ligne

                    select.selectedIndex = 0;
                    // Remet chaque menu sur sa première option
                });

                return;
                // Arrête ici l’exécution : la ligne n’est pas supprimée
            }

            row.remove();
            // Supprime complètement la ligne
        }
    });
});

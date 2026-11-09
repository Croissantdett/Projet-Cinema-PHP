document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.search-icon').forEach(function (searchBtn) {

        const wrapper = document.createElement('div');
        wrapper.classList.add('search-wrapper');
        searchBtn.parentNode.insertBefore(wrapper, searchBtn);
        wrapper.appendChild(searchBtn);

        const dropdown = document.createElement('div');
        dropdown.classList.add('search-dropdown');
        dropdown.innerHTML = `
            <input type="text" class="search-input" placeholder="Rechercher un film, acteur..." autocomplete="off" />
            <div class="search-results"></div>
        `;
        wrapper.appendChild(dropdown);

        const input   = dropdown.querySelector('.search-input');
        const results = dropdown.querySelector('.search-results');
        let timer     = null;

        // Clic sur la loupe : ouvrir/fermer
        searchBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            const isOpen = dropdown.classList.contains('search-dropdown--open');
            closeAllDropdowns();
            if (!isOpen) {
                dropdown.classList.add('search-dropdown--open');
                input.focus();
            }
        });

        // Frappe dans l'input
        input.addEventListener('input', function () {
            clearTimeout(timer);
            const q = input.value.trim();
            if (q.length < 2) {
                results.innerHTML = '<div class="search-no-result">Tapez au moins 2 caractères...</div>';
                return;
            }
            timer = setTimeout(function () {
                fetch(window.routes.recherche + '?q=' + encodeURIComponent(q))                    .then(r => r.json())
                    .then(data => {
                        results.innerHTML = '';
                        if (!data.length) {
                            results.innerHTML = '<div class="search-no-result">Aucun résultat</div>';
                            return;
                        }
                        data.forEach(function (item) {
                            const a = document.createElement('a');
                            a.href = item.url;
                            a.classList.add('search-result-item');

                            const imgHtml = item.img
                                ? `<img src="/images/${item.img}" alt="${item.nom}" class="search-result-img" />`
                                : `<div class="search-result-img search-result-img--placeholder"></div>`;

                            a.innerHTML = `
                                ${imgHtml}
                                <div class="search-result-info">
                                    <span class="search-result-name">${item.nom}</span>
                                    <span class="search-result-type">${item.type}</span>
                                </div>
                            `;
                            results.appendChild(a);
                        });
                    })
                    .catch(function () {
                        results.innerHTML = '<div class="search-no-result">Erreur de recherche</div>';
                    });
            }, 300);
        });

        dropdown.addEventListener('click', function (e) {
            e.stopPropagation();
        });
    });

    document.addEventListener('click', closeAllDropdowns);

    function closeAllDropdowns() {
        document.querySelectorAll('.search-dropdown--open').forEach(function (d) {
            d.classList.remove('search-dropdown--open');
        });
    }
});

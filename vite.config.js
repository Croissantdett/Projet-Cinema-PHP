import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/filtres_tous_films.js',
                    'resources/js/filtres_actuellement_cinema.js', 'resources/js/popup_connexion.js',
                    'resources/js/informations-utiles.js','resources/js/popup-gestion.js',
                    'resources/js/reservation.js', 'resources/js/ajout-personne.js','resources/js/loupe-recherche.js',],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});

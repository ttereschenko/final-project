import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/style.css',
                'resources/js/app.js',
                'resources/js/slider.js',
                'resources/js/datepicker.js',
                'resources/js/country-dropdown.js',
                'resources/js/pricerange.js',
            ],
            refresh: true,
        }),
        react(),
    ],
});

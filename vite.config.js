import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/styles.css',
                'resources/css/slike/pocetna_banner.png',
                
            ],
            refresh: true,
        }),
    ],
});
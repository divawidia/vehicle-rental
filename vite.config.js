import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/admin/css/app.css',
                'resources/assets/admin/js/app.js',
            ],
            refresh: true,
        }),
    ],
});

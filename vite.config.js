import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/admin/css/app.css',
                'resources/assets/admin/css/bootstrap.min.css',
                'resources/assets/admin/js/app.js',
                'resources/assets/client/css/app.css',
                'resources/assets/client/js/app.js',
            ],
            refresh: true,
        }),
    ],
});

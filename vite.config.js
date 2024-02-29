// vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        })
    ],
    build:{
        manifest: true,
        target: 'es2017',
        cssTarget: 'chrome61',
    },
});

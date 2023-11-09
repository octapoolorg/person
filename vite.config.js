// vite.config.js
import { build, defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        target: "ES2015",
        rollupOptions: {
            output: {
                format: 'system',
            },
        },
    }
});

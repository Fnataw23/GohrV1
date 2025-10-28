import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss', // или 'resources/css/app.css'
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    build: {
        assetsDir: '',
        rollupOptions: {
            output: {
                assetFileNames: '[name][extname]',
                entryFileNames: '[name].js',
            },
        },
    },
});

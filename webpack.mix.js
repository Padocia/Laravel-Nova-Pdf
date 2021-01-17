let mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');

mix.setPublicPath('dist')
    .sass('resources/scss/tailwind.scss', 'dist/css')
    .options({
        processCssUrls: false,
        postCss: [
            tailwindcss('./tailwind.config.js')
        ]
    });

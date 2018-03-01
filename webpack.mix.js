const { mix } = require('laravel-mix');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js([
    'resources/assets/js/jquery-3.2.1.min.js',
    'resources/assets/js/app.js',
    'resources/assets/js/fresco.js',
    'resources/assets/js/misc.js',
    'resources/assets/js/inview.js',
    'resources/assets/js/bootstrap-select.js'], 'public/js/app.js')

    .sass('resources/assets/sass/app.scss', 'public/css')
    .copy('resources/assets/images', 'public/images', false)
    .sourceMaps();
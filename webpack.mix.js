let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/sites/admin/js')
   .sass('resources/assets/sass/app.scss', 'public/sites/admin/css');
   // .js('resources/assets/js/app2.js', 'public/common/js')
   // .sass('resources/assets/sass/app2.scss', 'public/common/css');


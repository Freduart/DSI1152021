const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js').vue()
    .sass('resources/sass/app.scss', 'public/css')
    .webpackConfig(require('./webpack.config'));

// Dashboard theme assets...
mix.js('resources/js/dashboard.js', 'public/js')
    .sass('resources/sass/dashboard/dashboard.scss', 'public/css');

let mix = require('laravel-mix');

mix
  .js('resources/assets/js/app.js', 'public/js')
  .sourceMaps(false, 'source-map')
  .sass('resources/assets/sass/app.scss', 'public/css');

if (mix.inProduction()) {
    mix.version();
}
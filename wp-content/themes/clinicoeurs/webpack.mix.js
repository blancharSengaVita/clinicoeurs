const mix = require('laravel-mix');
// require('mix-white-bug-sass-icons');

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

// if(process.env.BUILD_ICONS) {
//    return mix.icons('resources/icons', 'resources/fonts')
// }

mix.sass('resources/sass/site.scss', '/css').sourceMaps()
  .ts('resources/ts/main.ts', '/js').sourceMaps()
  .setPublicPath('public')
  .browserSync({
    proxy: 'https://clinicoeurs.localhost'
  });

const mix = require("laravel-mix");

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

//global
mix.js("resources/js/app.js", "public/js").version()
    .vue()
    .sass("resources/sass/app.scss", "public/css");

//agent
mix.js("resources/js/agent/app.js", "public/js/agent").version()
    .vue()
    .sass("resources/sass/agent/app.scss", "public/css/agent");

//dealer
mix.js("resources/js/dealer/app.js", "public/js/dealer").version()
    .vue()
    .sass("resources/sass/dealer/app.scss", "public/css/dealer");
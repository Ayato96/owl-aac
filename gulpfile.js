const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
	mix.scripts([
        '../../../node_modules/jquery/dist/jquery.min.js',
        '../../../node_modules/bootstrap/dist/js/bootstrap.min.js',
        'owl.js'
    ], 'public/assets/js/owl.js');

    mix.styles([
        '../../../node_modules/bootstrap/dist/css/bootstrap.min.css',
        '../../../node_modules/bootstrap/dist/css/bootstrap-theme.min.css',
        'owl.css'
    ], 'public/assets/css/owl.css');

    mix.copy('node_modules/bootstrap/fonts','public/assets/fonts');

});
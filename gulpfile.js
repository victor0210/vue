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
var ScssFile = [
    'app.scss',
    'article-content.scss',
    'user-center.scss',
    'admin.scss'
];

var ScssPath = 'public/assets/css';


elixir(function (mix) {
    ScssFile.forEach(function (file) {
        mix.sass(file, ScssPath);
    });
});

elixir(function(mix) {
    mix.copy('resources/assets/images', 'public/images');
});
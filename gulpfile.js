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
    'admin.scss',
    'article.scss',
    'zoom.scss'
];

var JsFile = [
    'user-center.js'
];

var ScssPath = 'public/assets/css';
var JsPath = 'public/assets/js';


elixir(function (mix) {
    mix.scripts([
        'admin/jquery.js',
        'admin/bootstrap.js',
        'admin/Chart.js',
        'admin/metisMenu.js',
        'admin/app.js',
        'admin/frontend.js'
    ], JsPath+'/admin.js');

    ScssFile.forEach(function (file) {
        mix.sass(file, ScssPath);
    });

    JsFile.forEach(function (file) {
        mix.scripts(file, JsPath);
    });
});

elixir(function (mix) {
    mix.copy('resources/assets/images', 'public/images');
});
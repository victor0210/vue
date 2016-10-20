<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Auth::routes();

Route::group(['namespace' => 'Auth'], function () {
    Route::get('login', 'LoginController@showLoginForm');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');
    Route::get('register', 'LoginController@register');
    Route::post('register', 'RegisterController@store');
    Route::get('/home', function () {
        return redirect('/');
    });
});

Route::group(['namespace' => 'Web'], function () {
    Route::get('content/{id}', 'ArticlesController@index');
    Route::get('/article/{collection?}', ['as' => 'article', 'uses' => 'IndexController@index']);
    Route::get('/', ['as' => 'collection', 'uses' => 'IndexController@collection']);
    Route::get('music', 'MusicController@index');
});

Route::group(['namespace' => 'Web\Api', 'prefix' => 'api'], function () {
    Route::get('/searchArticle', 'ArticlesController@index');
    Route::post('/uploadImg', 'ArticlesController@uploadImg');
    Route::post('/collection-status', ['as' => 'collectionStatus', 'uses' => 'AdminController@collectionStatus']);
});

Route::group(['middleware' => 'auth', 'namespace' => 'Web'], function () {
    Route::post('send-comment/{id}', 'ArticlesController@postComment');
    Route::get('user', 'UserController@index');
    Route::get('add-article', 'ArticlesController@add');
    Route::post('post-article', 'ArticlesController@validateArticle');
    Route::get('mail', 'MailController@ship');
    Route::post('user/uploadAvatar', 'UserController@updateAvatar');
    Route::post('user/uploadBackground', 'UserController@updateBackground');
    Route::post('reply-comment', 'ArticlesController@reply');
});

Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'AdminController@index');
    Route::get('categories', 'AdminController@category');
    Route::post('categories/add-new-collection', 'AdminController@create');
    Route::get('categories/add-new-collection', 'AdminController@categoryAdd');
    Route::get('categories/edit/{id}', 'AdminController@categoryEdit');
    Route::post('categories/edit', 'AdminController@categoryUploadImage');
});

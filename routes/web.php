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
    Route::get('/recommend', 'IndexController@recommend');
    Route::get('about', 'StaticPageController@index');
    Route::get('user/{id}', 'OtherUserController@index');
    Route::get('user/{id}/article', 'OtherUserController@article');
    Route::get('/search', 'ArticlesController@search');
    Route::get('/faqs', 'StaticPageController@faq');
});

Route::group(['namespace' => 'Web\Api', 'prefix' => 'api'], function () {
    Route::get('/articles', 'ArticlesController@index');
    Route::get('/articles-page', 'ArticlesController@getArticlePage');
    Route::get('/articles-list', 'ArticlesController@getArticleList');
    Route::post('/uploadImg', 'ArticlesController@uploadImg');
    Route::post('/collection-status', ['as' => 'collectionStatus', 'uses' => 'AdminController@collectionStatus']);
    Route::post('/delete-record', 'UserController@deleteRecords');
    Route::post('/delete-article', 'UserController@deleteArticles');
    Route::post('/thumbs', 'ArticlesController@thumb')->middleware('auth');
});

Route::group(['middleware' => 'auth', 'namespace' => 'Web'], function () {
    Route::post('send-comment/{id}', 'ArticlesController@postComment');
    Route::get('user', 'UserController@index');
    Route::get('add-article', 'ArticlesController@add');
    Route::post('post-article', 'ArticlesController@validateArticle');
    Route::post('user/uploadAvatar', 'UserController@updateAvatar');
    Route::post('user/uploadBackground', 'UserController@updateBackground');
    Route::post('reply-comment', 'ArticlesController@reply');
    Route::get('/setting', 'UserController@setting');
    Route::post('/setting', 'UserController@setInfo');
    Route::get('/notification', 'NotificationsController@index');
    Route::post('/notification', 'NotificationsController@delete');
});

Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'AdminController@index');
    Route::get('categories', 'AdminController@category');
    Route::post('categories/add-new-collection', 'AdminController@create');
    Route::get('categories/add-new-collection', 'AdminController@categoryAdd');
    Route::get('categories/edit/{id}', 'AdminController@categoryEdit');
    Route::post('categories/edit', 'AdminController@categoryUploadImage');
    Route::get('/articles', 'ArticleController@index');
});

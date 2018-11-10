<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['domain' => 'admin.' . env('APP_DOMAIN'), 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::get('login', 'HomeController@showLoginForm')->name('login');
    Route::post('login', 'HomeController@login');
    Route::get('logout', 'HomeController@logout')->name('logout');
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
        Route::resource('user', 'UserController');
        Route::resource('article', 'ArticleController');
        Route::resource('article-category', 'ArticleCategoryController');
        Route::resource('link', 'LinkController');
        Route::resource('set', 'SetController');
    });
});


Route::group(['namespace' => 'Web'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('article/category/{slug}', 'ArticleController@index')->name('article_category');
    Route::resource('article', 'ArticleController');
});

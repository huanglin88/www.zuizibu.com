<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['domain' => 'admin.' . env('APP_DOMAIN'), 'namespace' => 'Admin'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::apiResource('user', 'UserController');
        Route::apiResource('article', 'ArticleController');
        Route::apiResource('article-category', 'ArticleCategoryController');

        Route::post('upload', 'HomeController@upload');
        Route::get('convert-slug', 'HomeController@convert_slug');
        Route::apiResource('link', 'LinkController');
    });
});

Route::get('verify-code', 'HomeController@verifyCode');
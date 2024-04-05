<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'Api'], function () {
    Route::get("test", 'HomeController@index');
    Route::post("contact", 'HomeController@contact');
    
    Route::post("login", 'AuthController@login');
    Route::post("register", 'AuthController@register');
    Route::post("forgetpassword", 'AuthController@forgetpassword');
    Route::post("newpassword", 'AuthController@newpassword');
    Route::post("logout", 'AuthController@logout');
    Route::post("changetype", 'AuthController@changetype');
    Route::post("promocode", 'AuthController@promocode');
    Route::post("reviews", 'ReviewController@index');
    Route::post("categories", 'ServiceController@categories');
    Route::group(['prefix' => 'services'], function () {
        Route::post("", 'ServiceController@index');
        Route::post("schedule", 'ServiceController@schedule');
        Route::post("popular", 'ServiceController@popular');
        Route::post("recommended", 'ServiceController@recommended');
        Route::get("show/{id}", 'ServiceController@show');
        Route::post("bookmarked", 'ServiceController@bookmarked');
        Route::post("favorite", 'ServiceController@favorite');
        Route::post("search", 'ServiceController@search');
        Route::post("filter", 'ServiceController@filter');
        Route::get("upcoming", 'ServiceController@upcoming');
        Route::post("book", 'ServiceController@book');
    });
    Route::group(['prefix' => 'inquires'], function () {
        Route::post("", 'InquireController@index');
        Route::post("show", 'InquireController@show');
        Route::post("store/message", 'InquireController@store_message');
        Route::get("services", 'InquireController@services');
        Route::get("requests", 'InquireController@requests');
        Route::get("done", 'InquireController@done');
        Route::post("schedule", 'InquireController@schedule');
    });
    Route::group(['prefix' => 'articles'], function () {
        Route::post("", 'ArticleController@index');
        Route::post("show", 'ArticleController@show');
    });
    Route::group(['prefix' => 'faqs'], function () {
        Route::post("", 'FaqController@index');
    });
    Route::post("inquires/create", 'InquireController@store');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post("update", 'AuthController@update');
        Route::post("profile", 'AuthController@profile');
        Route::group(['prefix' => 'notifications'], function () {
            Route::post("", 'NotificationController@index');
            Route::post("show", 'NotificationController@show');
            Route::post("read", 'NotificationController@read');
            Route::post("delete", 'NotificationController@delete');
            Route::post("delete/all", 'NotificationController@delete_all');
        });
        Route::group(['prefix' => 'bookmarks'], function () {
            Route::post("", 'BookmarkController@index');
            Route::post("create", 'BookmarkController@create');
            Route::post("delete", 'BookmarkController@delete');
        });
    });
});

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
    Route::post("login", 'AuthController@login');
    Route::post("register", 'AuthController@register');
    Route::post("forgetpassword", 'AuthController@forgetpassword');
    Route::post("newpassword", 'AuthController@newpassword');
    Route::post("logout", 'AuthController@logout');
    Route::post("update", 'AuthController@update');
    Route::post("changetype", 'AuthController@changetype');
    Route::post("promocode", 'AuthController@promocode');
    Route::get("reviews", 'ReviewController@index');
    Route::group(['prefix' => 'services'], function () {
        Route::get("", 'ServiceController@index');
        Route::get("schedule", 'ServiceController@schedule');
        Route::get("popular", 'ServiceController@popular');
        Route::get("recommended", 'ServiceController@recommended');
        Route::get("show", 'ServiceController@show');
        Route::post("bookmarked", 'ServiceController@bookmarked');
        Route::post("favorite", 'ServiceController@favorite');
        Route::post("search", 'ServiceController@search');
        Route::post("filter", 'ServiceController@filter');
        Route::get("upcoming", 'ServiceController@upcoming');
    });
    Route::group(['prefix' => 'inquires'], function () {
        Route::get("", 'InquireController@index');
        Route::get("show", 'InquireController@show');
        Route::post("create", 'InquireController@store');
        Route::post("store/message", 'InquireController@store_message');
        Route::get("services", 'InquireController@services');
        Route::get("requests", 'InquireController@requests');
        Route::get("done", 'InquireController@done');
        Route::post("schedule", 'InquireController@schedule');
    });
    Route::group(['prefix' => 'notifications'], function () {
        Route::get("", 'NotificationController@index');
        Route::post("show", 'NotificationController@show');
        Route::post("delete", 'NotificationController@delete');
        Route::post("delete/all", 'NotificationController@delete_all');
    });
    Route::group(['prefix' => 'articles'], function () {
        Route::get("", 'ArticleController@index');
        Route::post("show", 'ArticleController@show');
    });
    Route::group(['prefix' => 'faqs'], function () {
        Route::get("", 'FaqController@index');
    });
});

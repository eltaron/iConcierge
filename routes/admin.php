<?php

use Illuminate\Support\Facades\Route;

// Admin Routes
Route::group(['namespace' => 'Admin'], function () {
    Route::get("", 'LoginController@index');
    Route::post('login', 'UserController@login');
    Route::group(['middleware' => ['auth']], function () {
        Route::post('logout', 'UserController@logout');
        Route::post('profile', 'UserController@profile');
        Route::get("dashboard", "DashboardController@index");
        Route::group(['prefix' => 'categories'], function () {
            Route::get("", "CategoryController@index");
            Route::post("save", "CategoryController@save");
            Route::post("update", "CategoryController@update");
            Route::post("destory", "CategoryController@delete");
        });
        Route::group(['prefix' => 'services'], function () {
            Route::get("", "ServiceController@index");
            Route::post("save", "ServiceController@store");
            Route::post("update", "ServiceController@update");
            Route::post("destory", "ServiceController@delete");
        });
        Route::get("clients", "ClientController@index");
        Route::get("inquiries", "InquiryController@index");
        Route::get("activities", "ActivityController@index");
        Route::get("chats", "ChatController@index");
    });
});

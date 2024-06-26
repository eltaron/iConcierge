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

            Route::get("categories/{id}", "ServiceController@categories");
            Route::get("{id}", "ServiceController@show");
            Route::get("", "ServiceController@index");
            Route::post("save", "ServiceController@store");
            Route::post("update", "ServiceController@update");
            Route::post("destory", "ServiceController@delete");
            Route::post("details/delete", "ServiceController@detailsdestroy");
            Route::post("details/add", "ServiceController@detailsadd");
            Route::post("details/edit", "ServiceController@detailsedit");

            Route::post("image/add", "ServiceController@imageadd");
            Route::post("image/delete", "ServiceController@imagedelete");
        });
        Route::get("clients", "ClientController@index");
        Route::post("clients/delete", "ClientController@delete");
        Route::post("clients/edit", "ClientController@edit");
        Route::get("inquiries", "InquiryController@index");
        Route::get("activities", "ActivityController@index");
        Route::get("chats", "ChatController@index");
    });
    Route::group(['prefix' => "notifications"], function () {
        Route::get("", "NotificationController@index");
        Route::post("delete", "NotificationController@delete");
    });
    Route::group(['prefix' => "articles"], function () {
        Route::get("", "ArticleController@index");
        Route::post("save", "ArticleController@save");
        Route::post("delete", "ArticleController@delete");
        Route::post("update", "ArticleController@update");
    });
    Route::group(['prefix' => "bookings"], function () {
        Route::get("", "BookingController@index");
        Route::post("save", "BookingController@save");
        Route::post("delete", "BookingController@delete");
        Route::post("update", "BookingController@update");
    });
});

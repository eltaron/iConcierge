<?php

use Illuminate\Support\Facades\Route;

// Admin Routes
Route::group(['namespace' => 'Admin'], function () {
    Route::get("dashboard","DashboardController@index");
    Route::get("categories","CategoryController@index");
    Route::post("categories/save","CategoryController@save");
    Route::post("categories/update","CategoryController@save");
    Route::get("clients","ClientController@index");
    Route::get("inquiries","InquiryController@index");
    Route::get("activities","ActivityController@index");
    Route::get("chats","ChatController@index");
    Route::get("", 'HomeController@index');
    Route::get("login", 'LoginController@index');
    Route::post('login', 'UserController@login');
    Route::group(['middleware' => ['auth']], function () {
    });
});

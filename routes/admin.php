<?php

use Illuminate\Support\Facades\Route;

// Admin Routes
Route::group(['namespace' => 'Admin'], function () {
    Route::get("", 'HomeController@index');
    Route::post('login', 'UserController@login');
    Route::group(['middleware' => ['auth']], function () {
    });
});

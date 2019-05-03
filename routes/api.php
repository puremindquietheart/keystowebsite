<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// List single article

// Route::get('article/{id}', 'ArticleController@show');

// Create new article

Route::post('/admin-dashboard', 'Dashboard\AdminDashboardController@store');

// Update article

Route::put('/admin-dashboard/{id}', 'Dashboard\AdminDashboardController@update');

// Delete article

Route::delete('/admin-dashboard/{id}', 'Dashboard\AdminDashboardController@destroy');

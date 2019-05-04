<?php
// for keysto website
Route::resource('/', 'WebsiteController\KeystoController');
// login view
Route::get('/keysto-admin-login', 'Admin\AdminLoginController@userLogin')->middleware('revalidate');
// try login
Route::post('/user-login', 'Admin\AdminLoginController@loginAuthentication');
// user logout
Route::get('/user-logout', 'Admin\AdminLoginController@userLogout')->middleware('revalidate');
// route for vue
Route::get('/{path}', 'Dashboard\DashboardController@dashboard')->where('path', '([A-z\d-\/_.]+)?');
// route fo dashboard
Route::get('/keysto-admin-dashboard', 'Dashboard\DashboardController@dashboard');
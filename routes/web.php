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
Route::get('/keysto-admin-login/{any}', 'Admin\AdminLoginController@userLogin')->where('any', '.*');
Route::get('/keysto-admin-dashboard/{any}', 'Dashboard\AdminDashboardController@dashboard')->where('any', '.*');
// route fo dashboard
Route::get('/keysto-admin-dashboard', 'Dashboard\AdminDashboardController@dashboard');
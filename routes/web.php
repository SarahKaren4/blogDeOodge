<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::namespace('Site')->group(function () {
    Auth::routes();
    Route::get('/', ['as' => 'site.home', 'uses' => 'SiteController@index']);
});

Route::namespace('Admin')->group(function () {
    Route::prefix('admin')->group(function () {

        Route::get('/login', ['as' => 'admin.login', 'uses' => 'Auth\LoginController@showLoginForm']);
        Route::post('/login', ['as' => 'admin.login.submit', 'uses' => 'Auth\LoginController@login']);
        Route::get('/register', ['as' => 'admin.register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
        Route::post('/register', ['as' => 'admin.register.submit', 'uses' => 'Auth\RegisterController@register']);
        Route::post('/logout', ['as' => 'admin.logout', 'uses' => 'Auth\LoginController@logout']);
        Route::post('/password/email', ['as' => 'admin.password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
        Route::get('/password/reset', ['as' => 'admin.password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
        Route::post('/password/reset', ['as' => 'admin.password.reset.request', 'uses' => 'Auth\ResetPasswordController@reset']);
        Route::get('/password/reset/{token}', ['as' => 'admin.password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);

        Route::get('/', ['as' => 'admin.home', 'uses' => 'AdminController@index']);
    });
});

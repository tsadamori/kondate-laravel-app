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

Route::get('/signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('/signup', 'Auth\RegisterController@register')->name('signup.post');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login.post');
Route::post('/google_login', 'Auth\LoginController@googleLogin')->name('googleLogin.post');
Route::get('/login/google', 'Auth\LoginController@redirectToGoogle');
Route::get('/login/google/callback', 'Auth\LoginController@handleGoogleCallback');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/profile', 'UserController@show')->name('users.show');
    Route::get('/edit', 'UserController@edit')->name('users.edit');
    Route::put('/update', 'UserController@update')->name('users.update');
    Route::get('/password_change', 'UserController@password_change')->name('users.password_change');
    Route::post('/delete', 'UserController@delete')->name('users.delete');
    
    Route::get('/', 'MenusController@index')->name('/');
    Route::resource('menus', 'MenuController');
    Route::post('menus/search', 'MenuController@search')->name('menus.search');
    Route::post('menus/add_kondate', 'MenuController@add_kondate')->name('menus.add_kondate');
    Route::post('menus/list', 'KondateController@generate_kondate_list')->name('menus.list');
    
    Route::get('kondate/history', 'KondateController@history')->name('kondate.history');
    Route::get('kondate/history/{id}', 'KondateController@history_detail');
    Route::post('kondate/save_kondate_list', 'KondateController@save_kondate_list')->name('kondate.save');
    Route::post('kondate/delete', 'KondateController@delete');
});
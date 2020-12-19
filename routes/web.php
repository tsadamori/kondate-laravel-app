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

Route::get('/', 'MenusController@index')->name('/');
Route::group(['middleware' => ['auth']], function() {
    Route::resource('menus', 'MenusController');
});

// signup
Route::get('/signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('/signup', 'Auth\RegisterController@register')->name('signup.post');
// login
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login.post');
// google login
Route::post('/google_login', 'Auth\LoginController@googleLogin')->name('googleLogin.post');
Route::get('/login/google', 'Auth\LoginController@redirectToGoogle');
Route::get('/login/google/callback', 'Auth\LoginController@handleGoogleCallback');
// logout
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// user
Route::get('/profile', 'UsersController@show')->name('users.show');
Route::get('/password_change', 'UsersController@password_change')->name('users.password_change');
Route::get('/delete', 'UsersController@delete')->name('users.delete');

// menus
Route::post('menus/search', 'MenusController@search')->name('menus.search');
Route::post('menus/add_kondate', 'MenusController@add_kondate')->name('menus.add_kondate');
Route::post('menus/list', 'KondateController@generate_kondate_list')->name('menus.list');
Route::post('kondate/save_kondate_list', 'KondateController@save_kondate_list')->name('kondate.save');

// kondate
Route::get('kondate/history', 'KondateController@history')->name('kondate.history');
Route::get('kondate/history/{id}', 'KondateController@history_detail');
Route::post('kondate/delete', 'KondateController@delete');
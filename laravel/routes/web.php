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


Route::get('/', 'StaticPagesController@home')->name('home');;
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');
Route::get('/signup', 'UsersController@register')->name('signup');
Route::resource('users','UsersController');

Route::get('/login', 'SessionController@toLogin')->name('login');
Route::post('/login', 'SessionController@login')->name('login');
Route::get('/logout', 'SessionController@destory')->name('logout');

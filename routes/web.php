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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/register', 'LoginController@register')->name('register');
Route::get('/login', 'LoginController@login')->name('login');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/create', 'HomeController@create')->name('space.create');
Route::get('/store', 'HomeController@store')->name('space.store');

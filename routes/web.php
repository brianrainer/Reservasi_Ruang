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
    return view('room');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/room', 'MainController@test')->name('room');
Route::get('/form', 'ReservationController@create')->name('form');
Route::post('/form/submit', 'ReservationController@store')->name('formsubmit');
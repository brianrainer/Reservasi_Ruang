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

Auth::routes();

Route::get('/', function(){return view('welcome');});

Route::get('/home', function(){return view('home');});

Route::prefix('room')->group(function(){
  Route::get('/', 'RoomController@index');
});

Route::prefix('reserve')->group(function(){
  Route::get('/', 'ReservationController@index');
  Route::post('/', 'ReservationController@store');
  Route::get('/once', 'ReservationController@once_index');
});

Route::prefix('profile')->group(function(){
  Route::get('/', 'ProfileController@index');
});


// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/', 'MainController@availability');
// Route::get('/availability', 'MainController@availability');
// Route::get('/availability/{roomid}', function($roomid){
//   echo 'Availability for Room ID: '.$roomid;
// });
// Route::get('/rooms', 'MainController@rooms')->name('rooms');
// Route::get('/calendar', 'MainController@calendar')->name('calendar');
// Route::get('/form', 'ReservationController@create')->name('form');
// Route::post('/form', 'ReservationController@store')->name('formsubmit');
// Route::get('/booklist', 'BookingController@index')->name('booklist');
// Route::get('/schedule', 'ScheduleController@index');

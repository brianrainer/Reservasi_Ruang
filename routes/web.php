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
  Route::get('once', 'ReservationController@once_index');
  Route::post('once', 'ReservationController@once');
  Route::get('repeat', 'ReservationController@repeat_index');
  Route::post('repeat', 'ReservationController@repeat');
  Route::get('multionce', 'ReservationController@multionce_index');
  Route::post('multionce', 'ReservationController@multionce');
  Route::get('multirepeat', 'ReservationController@multirepeat_index');
  Route::post('multirepeat', 'ReservationController@multirepeat');

  Route::get('status', 'ReservationController@check_booking');
  Route::get('status/{booking}', 'ReservationController@check_booking_detail');
});

Route::prefix('profile')->group(function(){
  Route::get('/', 'ProfileController@index');
});

Route::get('terms', 'ReservationController@terms');

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

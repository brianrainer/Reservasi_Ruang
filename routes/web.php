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

Route::get('/', 'ReservationController@index_welcome');

Route::get('/home', function(){return view('home');});

Route::prefix('room')->group(function(){
  Route::get('/', 'RoomController@index');
  Route::get('detail/{room}', 'RoomController@index_room_detail');
  Route::get('edit/{room}', 'RoomController@index_edit');
  Route::post('edit/{room}', 'RoomController@edit');
  Route::get('create', 'RoomController@index_create');
  Route::post('create', 'RoomController@create');
});

Route::prefix('reserve')->group(function(){
  Route::get('/', 'ReservationController@index_reserve');
  Route::get('once', 'ReservationController@index_once');
  Route::get('repeat', 'ReservationController@index_repeat');
  Route::get('multionce', 'ReservationController@index_multi_once');
  Route::get('multirepeat', 'ReservationController@index_multi_repeat');

  Route::post('once', 'ReservationController@once');
  Route::post('repeat', 'ReservationController@repeat');
  Route::post('multionce', 'ReservationController@multionce');
  Route::post('multirepeat', 'ReservationController@multirepeat');

  Route::prefix('status')->group(function(){
    Route::get('/', 'ReservationController@index_status');
    Route::get('{booking}', 'ReservationController@index_detail');
    Route::post('reject', 'ReservationController@reject_one_reservation');
    Route::post('reject_all', 'ReservationController@reject_all_reservation');
    Route::post('accept', 'ReservationController@accept_one_reservation');
    Route::post('accept_all', 'ReservationController@accept_all_reservation');
  });
});

Route::prefix('profile')->group(function(){
  Route::get('/', 'ProfileController@index');
});

Route::get('terms', 'ReservationController@index_terms');

Route::prefix('agenda')->group(function(){
  Route::get('/', 'ReservationController@index_agenda');
  Route::get('{room_code}', 'ReservationController@index_room_agenda');
});

Route::prefix('calendar')->group(function(){
  Route::get('/', 'ReservationController@index_calendar');
  Route::prefix('accepted')->group(function(){
    Route::get('/', 'ReservationController@get_booking_calendar_accepted');
    Route::get('{room_code}', 'ReservationController@get_room_booking_calendar_accepted');
  });
  Route::get('waiting', 'ReservationController@get_booking_calendar_waiting');
  Route::get('rejected', 'ReservationController@get_booking_calendar_rejected');
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

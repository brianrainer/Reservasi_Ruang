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

Route::prefix('staff')->middleware('auth')->group(function(){
  Route::get('/', 'StaffController@index');
  Route::get('create', 'StaffController@create');
  Route::get('{user_id}', 'StaffController@edit');

  Route::post('create', 'StaffController@store');
  Route::post('{user_id}', 'StaffController@update');
});

Route::prefix('room')->group(function(){
  Route::get('/', 'RoomController@index');
  Route::get('detail/{room}', 'RoomController@index_room_detail');
  Route::middleware('auth')->group(function(){
    Route::get('edit/{room}', 'RoomController@index_edit');
    Route::post('edit/{room}', 'RoomController@edit');
    Route::get('create', 'RoomController@index_create');
    Route::post('create', 'RoomController@create');
    Route::post('delete', 'RoomController@delete');
  });
});

Route::prefix('reserve')->group(function(){

  Route::get('/', 'ReservationController@index_reserve');
  Route::get('once', 'ReservationController@index_once');
  Route::get('repeat', 'ReservationController@index_repeat');
  Route::get('multionce', 'ReservationController@index_multi_once');
  Route::get('multirepeat', 'ReservationController@index_multi_repeat');
  
  Route::get('status', 'ReservationController@index_status');
  Route::get('status/{booking}', 'ReservationController@index_detail');

  Route::prefix('/')->group(function(){
    Route::post('once', 'ReservationController@once');
    Route::post('repeat', 'ReservationController@repeat');
    Route::post('multionce', 'ReservationController@multionce');
    Route::post('multirepeat', 'ReservationController@multirepeat');
    Route::middleware('auth')->prefix('status')->group(function(){
      Route::post('reject', 'ReservationController@reject_one_reservation');
      Route::post('reject_all', 'ReservationController@reject_all_reservation');
      Route::post('accept', 'ReservationController@accept_one_reservation');
      Route::post('accept_all', 'ReservationController@accept_all_reservation');
      Route::post('pending', 'ReservationController@pending_one_reservation');
      Route::post('pending_all', 'ReservationController@pending_all_reservation');
      Route::post('edit', 'ReservationController@edit_one_reservation');
      Route::post('add', 'ReservationController@add_one_reservation');
      Route::post('delete', 'ReservationController@delete_one_detail');
      Route::post('delete_all', 'ReservationController@delete_all_detail');
    });

  });
});

Route::prefix('profile')->group(function(){
  Route::get('/', 'ProfileController@index');
});

Route::prefix('agenda')->group(function(){
  Route::get('/', 'ReservationController@index_agenda');
  Route::get('{room_code}', 'ReservationController@index_room_agenda');
});

Route::prefix('calendar')->group(function(){
  Route::get('/', 'ReservationController@index_calendar');
  // API for calendar
  Route::prefix('accepted')->group(function(){
    Route::get('/', 'ReservationController@get_booking_calendar_accepted');
    Route::get('{room_code}', 'ReservationController@get_room_booking_calendar_accepted');
  });
  Route::get('waiting', 'ReservationController@get_booking_calendar_waiting');
  Route::get('rejected', 'ReservationController@get_booking_calendar_rejected');
  Route::get('status', 'ReservationController@get_room_status');
});

// Download pdf
Route::get('{booking_id}/surat_ijin', 'ReservationController@download_pdf');

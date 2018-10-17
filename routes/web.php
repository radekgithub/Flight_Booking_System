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
    return view('home');
});

Route::resource('tourists', 'TouristsController');

Route::put('tourists/{id}/cancelBooking', 'TouristsController@cancelBooking');

Route::resource('flights', 'FlightsController');

Route::put('flights/{id}/cancelBooking', 'FlightsController@cancelBooking');
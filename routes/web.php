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
    return view('welcome-content');
});

// User Routes
Route::get('user-welcome', 'UserController@index');


// Booking Routes
//Route::get('booking-form', 'UserController@showBookingForm');
Route::get('available-seats/{id}', 'UserController@getAvailableSeat');

Route::post('booking-now', 'UserController@bookingNow')->name('booking-now');
Route::get('show-bus-list', 'UserController@showBusList')->name('show-bus-list');
Route::get('show-bus-seat-detail/{id}', 'UserController@showBusSeatDetail')->name('booking-form');
Route::get('addBus', 'UserController@showAddBusForm')->name('addBus');
Route::post('user-add-bus', 'UserController@addBus')->name('user-add-bus');
Route::get('pdfview',array('as'=>'pdfview','uses'=>'UserController@pdfview'));
Route::get('pdfviewbus',array('as'=>'pdfviewbus','uses'=>'UserController@pdfviewbus'));
Route::delete('/bus/delete/{id}','UserController@destroy')->name('bus-delete');
Route::get('/bus/{id}/edit','UserController@edit')->name('bus-edit');
Route::put('/bus/update/{id}','UserController@update')->name('bus-update');
Route::get('export', 'UserController@export')->name('export');
Route::get('importExportView', 'UserController@importExportView');
Route::post('import', 'UserController@import')->name('import');





// Reports Routes

Route::group(['prefix' => 'reports', 'namespace' => 'Reports'], function () {
    Route::get('reports/booking', 'ReportController@booking')->name('report.booking');
    Route::get('reports/bus', 'ReportController@bus')->name('report.bus');
});

Route::group(['prefix' => 'profiles', 'namespace' => 'profiles'], function () {

    Route::get('my-profile', 'ProfileController@myProfile')->name('profiles.myProfile');
    Route::put('{id}', 'ProfileController@update')->name('profiles.update');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

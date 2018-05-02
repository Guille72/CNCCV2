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

Route::get( '/', function () {
	return view( 'welcome' );
} );

Auth::routes();
Route::get( '/home', 'HomeController@index' )->name( 'home' );

Route::get( '/admin/dashboard', 'Admin\DashboardController@index' )->name('admin')->middleware( 'can:admin' );

// Booking
Route::get( '/bookings', 'BookingController@index' )->name( 'bookings' )->middleware( 'can:admin' );
Route::get( '/bookings/create', 'BookingController@create' )->name( 'bookingCreate' )->middleware( 'can:admin' );
Route::post( '/bookings/create', 'BookingController@store', ['before' => 'csrf'] )->name( 'bookingStore' )->middleware( 'can:admin' );
Route::get( '/bookings/edit/{id}', 'BookingController@edit' )->name( 'bookingEdit' )->middleware( 'can:admin' );
Route::put( '/bookings/edit/{id}', 'BookingController@update', ['before' => 'csrf'] )->name( 'bookingUpdate' )->middleware( 'can:admin' );
Route::get( '/bookings/show/{id}/', 'BookingController@show' )->name( 'bookingShow' )->middleware( 'can:admin' );
Route::delete( '/bookings/delete/{id}', 'BookingController@destroy', ['before' => 'csrf'] )->name( 'bookingDestroy' )->middleware( 'can:admin' );

// Event
Route::get( '/events', 'EventController@index' )->name( 'events' )->middleware( 'can:admin' );
Route::get( '/events/create', 'EventController@create' )->name( 'eventCreate' )->middleware( 'can:admin' );
Route::post( '/events/create', 'EventController@store', ['before' => 'csrf'] )->name( 'eventStore' )->middleware( 'can:admin' );
Route::get( '/events/edit/{id}', 'EventController@edit' )->name( 'eventEdit' )->middleware( 'can:admin' );
Route::put( '/events/edit/{id}', 'EventController@update', ['before' => 'csrf'] )->name( 'eventUpdate' )->middleware( 'can:admin' );
Route::get( '/events/show/{id}/', 'EventController@show' )->name( 'eventShow' )->middleware( 'can:admin' );
Route::delete( '/events/delete/{id}', 'EventController@destroy', ['before' => 'csrf'] )->name( 'eventDestroy' )->middleware( 'can:admin' );

// Logement
Route::get( '/logements', 'LogementController@index' )->name( 'logements' )->middleware( 'can:admin' );
Route::get( '/logements/create', 'LogementController@create' )->name( 'logementCreate' )->middleware( 'can:admin' );
Route::post( '/logements/create', 'LogementController@store', ['before' => 'csrf'] )->name( 'logementStore' )->middleware( 'can:admin' );
Route::get( '/logements/edit/{id}', 'LogementController@edit' )->name( 'logementEdit' )->middleware( 'can:admin' );
Route::put( '/logements/edit/{id}', 'LogementController@update', ['before' => 'csrf'] )->name( 'logementUpdate' )->middleware( 'can:admin' );
Route::get( '/logements/show/{id}/', 'LogementController@show' )->name( 'logementShow' )->middleware( 'can:admin' );
Route::delete( '/logements/delete/{id}', 'LogementController@destroy', ['before' => 'csrf'] )->name( 'logementDestroy' )->middleware( 'can:admin' );

// Note
Route::get( '/notes', 'NoteController@index' )->name( 'notes' )->middleware( 'can:admin' );
Route::get( '/notes/create', 'NoteController@create' )->name( 'noteCreate' )->middleware( 'can:admin' );
Route::post( '/notes/create', 'NoteController@store', ['before' => 'csrf'] )->name( 'noteStore' )->middleware( 'can:admin' );
Route::get( '/notes/edit/{id}', 'NoteController@edit' )->name( 'noteEdit' )->middleware( 'can:admin' );
Route::put( '/notes/edit/{id}', 'NoteController@update', ['before' => 'csrf'] )->name( 'noteUpdate' )->middleware( 'can:admin' );
Route::get( '/notes/show/{id}/', 'NoteController@show' )->name( 'noteShow' )->middleware( 'can:admin' );
Route::delete( '/notes/delete/{id}', 'NoteController@destroy', ['before' => 'csrf'] )->name( 'noteDestroy' )->middleware( 'can:admin' );

// ParametrePrix
Route::get( '/parametres', 'ParametreController@index' )->name( 'parametres' )->middleware( 'can:admin' );
Route::get( '/parametres/create', 'ParametreController@create' )->name( 'parametreCreate' )->middleware( 'can:admin' );
Route::post( '/parametres/create', 'ParametreController@store', ['before' => 'csrf'] )->name( 'parametreStore' )->middleware( 'can:admin' );
Route::get( '/parametres/edit/{id}', 'ParametreController@edit' )->name( 'parametreEdit' )->middleware( 'can:admin' );
Route::put( '/parametres/edit/{id}', 'ParametreController@update', ['before' => 'csrf'] )->name( 'parametreUpdate' )->middleware( 'can:admin' );
Route::get( '/parametres/show/{id}/', 'ParametreController@show' )->name( 'parametreShow' )->middleware( 'can:admin' );
Route::delete( '/parametres/delete/{id}', 'ParametreController@destroy', ['before' => 'csrf'] )->name( 'parametreDestroy' )->middleware( 'can:admin' );

// User
Route::get( '/users', 'UserController@index' )->name( 'users' )->middleware( 'can:admin' );
Route::get( '/users/create', 'UserController@create' )->name( 'userCreate' )->middleware( 'can:admin' );
Route::post( '/users/create', 'UserController@store' , ['before' => 'csrf'] )->name( 'userStore' )->middleware( 'can:admin' );
Route::get( '/users/edit/{id}', 'UserController@edit' )->name( 'userEdit' )->middleware( 'can:admin' );
Route::put( '/users/edit/{id}', 'UserController@update', ['before' => 'csrf'] )->name( 'userUpdate' )->middleware( 'can:admin' );
Route::get( '/users/show/{id}/', 'UserController@show' )->name( 'userShow' )->middleware( 'can:admin' );
Route::delete( '/users/delete/{id}', 'UserController@destroy', ['before' => 'csrf'])->name( 'userDestroy' )->middleware( 'can:admin' );

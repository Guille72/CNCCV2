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
Route::get('/home', 'HomeController@index')->name('home');

// Booking
Route::get('/bookings', 'BookingController@index')->name('bookings')->middleware('auth');
Route::get('/bookings/create', 'BookingController@create')->name('bookingCreate')->middleware('auth');
Route::post('/bookings/create', 'BookingController@store')->name('bookingStore')->middleware('auth');
Route::get('/bookings/edit/{id}', 'BookingController@edit')->name('bookingEdit')->middleware('auth');
Route::put('/bookings/edit/{id}', 'BookingController@update')->name('bookingUpdate')->middleware('auth');
Route::get('/bookings/show/{id}/', 'BookingController@show')->name('bookingShow')->middleware('auth');
Route::delete('/bookings/delete/{id}', 'BookingController@destroy')->name('bookingDestroy')->middleware('auth');

// Event
Route::get('/events', 'EventController@index')->name('events')->middleware('auth');
Route::get('/events/create', 'EventController@create')->name('eventCreate')->middleware('auth');
Route::post('/events/create', 'EventController@store')->name('eventStore')->middleware('auth');
Route::get('/events/edit/{id}', 'EventController@edit')->name('eventEdit')->middleware('auth');
Route::put('/events/edit/{id}', 'EventController@update')->name('eventUpdate')->middleware('auth');
Route::get('/events/show/{id}/', 'EventController@show')->name('eventShow')->middleware('auth');
Route::delete('/events/delete/{id}', 'EventController@destroy')->name('eventDestroy')->middleware('auth');

// Logement
Route::get('/logements', 'LogementController@index')->name('logements')->middleware('auth');
Route::get('/logements/create', 'LogementController@create')->name('logementCreate')->middleware('auth');
Route::post('/logements/create', 'LogementController@store')->name('logementStore')->middleware('auth');
Route::get('/logements/edit/{id}', 'LogementController@edit')->name('logementEdit')->middleware('auth');
Route::put('/logements/edit/{id}', 'LogementController@update')->name('logementUpdate')->middleware('auth');
Route::get('/logements/show/{id}/', 'LogementController@show')->name('logementShow')->middleware('auth');
Route::delete('/logements/delete/{id}', 'LogementController@destroy')->name('logementDestroy')->middleware('auth');

// Note
Route::get('/notes', 'NoteController@index')->name('notes')->middleware('auth');
Route::get('/notes/create', 'NoteController@create')->name('noteCreate')->middleware('auth');
Route::post('/notes/create', 'NoteController@store')->name('noteStore')->middleware('auth');
Route::get('/notes/edit/{id}', 'NoteController@edit')->name('noteEdit')->middleware('auth');
Route::put('/notes/edit/{id}', 'NoteController@update')->name('noteUpdate')->middleware('auth');
Route::get('/notes/show/{id}/', 'NoteController@show')->name('noteShow')->middleware('auth');
Route::delete('/notes/delete/{id}', 'NoteController@destroy')->name('noteDestroy')->middleware('auth');

// ParametrePrix
Route::get('/parametres-prix', 'ParametrePrixController@index')->name('parametresPrix')->middleware('auth');
Route::get('/parametres-prix/create', 'ParametrePrixController@create')->name('parametrePrixCreate')->middleware('auth');
Route::post('/parametres-prix/create', 'ParametrePrixController@store')->name('parametrePrixStore')->middleware('auth');
Route::get('/parametres-prix/edit/{id}', 'ParametrePrixController@edit')->name('parametrePrixEdit')->middleware('auth');
Route::put('/parametres-prix/edit/{id}', 'ParametrePrixController@update')->name('parametrePrixUpdate')->middleware('auth');
Route::get('/parametres-prix/show/{id}/', 'ParametrePrixController@show')->name('parametrePrixShow')->middleware('auth');
Route::delete('/parametres-prix/delete/{id}', 'ParametrePrixController@destroy')->name('parametrePrixDestroy')->middleware('auth');

// User
Route::get('/users', 'UserController@index')->name('users')->middleware('auth');
Route::get('/users/create', 'UserController@create')->name('userCreate')->middleware('auth');
Route::post('/users/create', 'UserController@store')->name('userStore')->middleware('auth');
Route::get('/users/edit/{id}', 'UserController@edit')->name('userEdit')->middleware('auth');
Route::put('/users/edit/{id}', 'UserController@update')->name('userUpdate')->middleware('auth');
Route::get('/users/show/{id}/', 'UserController@show')->name('userShow')->middleware('auth');
Route::delete('/users/delete/{id}', 'UserController@destroy')->name('userDestroy')->middleware('auth');

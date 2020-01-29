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
// Route::get('{path}', function () {
//     return view('index');
// })->where('path', '(.*)');

Route::get('/', function () {
    return view('welcome');
});

Route::get('index', function () {
    return view('index');
});

Route::get('events', function () {
    return view('events');
});

Route::get('single-event', function () {
    return view('single-event');
});

Route::get('/events', 'EventController@index');
Route::post('/events', 'EventController@store');
Route::put('/events/{event}', 'EventController@update');
Route::delete('/events/{event}', 'EventController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


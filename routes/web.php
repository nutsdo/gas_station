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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'GasStationController@index')->name('index');
Route::get('gasStation/{gasStation}/show', 'GasStationController@show')->name('station.show');
Route::get('gasStation/{gasStation}/comments', 'GasStationCommentsController@index')->name('station.comments');
Route::get('gasStation/{gasStation}/comments/create', 'GasStationCommentsController@create')->name('station.comments.create');
Route::post('gasStation/{gasStation}/comments', 'GasStationCommentsController@store')->name('station.comments.store');
//Route::get('/', 'IndexController@index')->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('upload', [
    'as' => 'upload', 'uses' => 'UploadController@upload'
]);

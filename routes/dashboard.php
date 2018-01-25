<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/2
 * Time: 下午10:32
 */
Route::get('/', 'HomeController@index')->name('dashboard.home');

Route::resource('gasStations', 'GasStationsController');

Route::resource('series', 'SeriesController');

Route::resource('gasStations.comments', 'GasStationCommentController');

Route::resource('gasStations.series', 'GasStationSeriesController');

Route::get('/user/edit', 'UserController@edit')->name('user.edit');

Route::put('/user/update', 'UserController@update')->name('user.update');


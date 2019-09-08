<?php

Auth::routes();

Route::get('/', 'ContributionController@index')->name('home');
Route::post('/', 'ContributionController@store')->middleware('auth');
Route::post('/vote', 'ContributionController@vote')->middleware('auth');

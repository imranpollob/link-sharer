<?php

Auth::routes();

Route::get('/', 'ContributionController@index')->name('home');
Route::post('/', 'ContributionController@store')->middleware('auth');

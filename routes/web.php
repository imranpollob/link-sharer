<?php

Auth::routes();

Route::get('/', 'ContributionController@index')->name('home');

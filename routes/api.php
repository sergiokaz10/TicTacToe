<?php


Route::get('match', 'MatchController@all')->name('all');
Route::get('match/{id}', 'MatchController@show')->name('show');
Route::put('match/{id}', 'MatchController@update')->name('update');
Route::post('match', 'MatchController@store')->name('store');
Route::delete('match/{id}', 'MatchController@delete')->name('delete');
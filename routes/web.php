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



Route::resource('sicks', 'SickController')->except([
    'destroy', 'show'
]);
Route::get('/', 'SickController@create')->name('home');
Route::get('/county/{id?}', 'CityController@ajaxCounty')->name('ajax.county');
Route::get('/province/{id}', 'CityController@ajaxProvince')->name('ajax.province');

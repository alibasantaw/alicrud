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

Route::resource('/profil','Profil');
Route::resource('/create','Profil');
Route::resource('/edit','Profil');
Route::get('downloadExcel/{type}', 'Profil@downloadExcel');

Route::get('/export', 'Profil@index')->name('View');
Route::any('/send', 'Profil@submit');
Route::get('/import/{coba}', 'Profil@detail');
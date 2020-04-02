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


Route::get('/','AboutPagesController@home');
Route::get('/about','AboutPagesController@about');
Route::get('/contactMe','AboutPagesController@contactMe');


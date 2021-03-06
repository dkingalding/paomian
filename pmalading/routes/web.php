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

Route::get('/','AboutPagesController@home')->middleware('verified');
Route::get('/home','AboutPagesController@home');
Route::get('/about','AboutPagesController@about');
Route::get('/contactMe','AboutPagesController@contactMe');


Auth::routes(['verify' => true]);

Route::redirect('/', '/products')->name('root');
Route::get('products', 'ProductsController@index')->name('products.index');

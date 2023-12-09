<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {return view('index');});

//new payment routes
Route::get('/payment/add', 'PaymentController@index')->name('payment');
Route::post('/payment/submitPayment', 'PaymentController@insertPayment');

//payment history routes
Route::get('/history/view', 'HistoryController@index')->name('history');
Route::post('/history/delete/{id}', 'HistoryController@delete');



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

Route::get('actionplans/datatables', 'actionPlansController@datatables');
Route::get('actions/datatables/{id}', 'QualityactionController@datatables');
Route::get('teste', 'ComercialController@visitasPorClien');
Route::get('c123', 'ComercialController@getFaturamentoC123');


Route::resource('dashboard', 'DashboardController');
Route::resource('events', 'EventController');
Route::resource('actionplans', 'actionPlansController');
Route::resource('actions', 'QualityactionController');
Route::resource('comercial', 'ComercialController');



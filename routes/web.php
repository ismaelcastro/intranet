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

Route::get('contratos-locacao/datatables', 'ContratosContoller@datatables');

Route::prefix('relatorios')->group(function(){
    Route::get('comercial/sugestaoCompra', 'Rel\Comercial\ComercialController@sugestaoCompra');
    Route::resource('comercial', 'Rel\Comercial\ComercialController');
    Route::resource('estoque', 'Rel\Estoque\EstoqueController');
    Route::resource('f212', 'Rel\Financeiro\F212Controller');
    Route::resource('RelS016', 'Rel\Estoque\RelS016');
    Route::resource('RelF212', 'Rel\Financeiro\Financeiro212Controller');
});

Route::resource('/', 'DashboardController');
Route::resource('events', 'EventController');
Route::resource('actionplans', 'actionPlansController');
Route::resource('actions', 'QualityactionController');
Route::resource('financeiro', 'FinanceiroController');
Route::resource('propostas', 'PropostasController');
Route::resource('contratos-locacao', 'ContratosContoller');
Route::resource('clientes', 'ClienteController');
Route::resource('produtos', 'ProdutosController');
Route::resource('estoque', 'EstoqueController');
Route::resource('summaryobj', 'SummaryObjController');

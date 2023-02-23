<?php

use Illuminate\Support\Facades\Route;
use App\Mail\MensagemTesteMail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('welcome');

Route::resource('votacaoAlmoco', 'App\Http\Controllers\VotacaoAlmocoController');
Route::put('votacaoAlmoco/votarAlmoco/{id}', 'App\Http\Controllers\VotacaoAlmocoController@votarAlmoco')->name('votarAlmoco');

Route::resource('votacaoCafe', 'App\Http\Controllers\VotacaoCafeController');
Route::put('votacaoCafe/votarCafe/{id}', 'App\Http\Controllers\VotacaoCafeController@votarCafe')->name('votarCafe');

Auth::routes(['verify' => true]);
Route::get('/dashboard', 'App\Http\Controllers\HomeController@dashboard')->name('dashboard')->middleware('verified');

Route::resource('cafe', 'App\Http\Controllers\CafeController')->middleware('verified');

Route::resource('almoco', 'App\Http\Controllers\AlmocoController')->middleware('verified');

Route::resource('administrativo', 'App\Http\Controllers\AdministrativoController')->middleware('permissao');


Route::any('relatorio', 'App\Http\Controllers\RelatorioController@index')->name('relatorioIndex')->middleware('verified');

Route::any('relatorio/detalhe', 'App\Http\Controllers\RelatorioController@detalhe')->name('detalhe')->middleware('verified');

Route::get('relatorio/exportacao/{extensao}/{tipo}/{ano}/{mes}/{titulo}', 'App\Http\Controllers\RelatorioController@exportacao')
    ->name('relatorio.exportacao')->middleware('verified');

Route::get('relatorio/exportar/{tipo}/{ano}/{mes}/{titulo}', 'App\Http\Controllers\RelatorioController@exportar')
    ->name('relatorio.exportar')->middleware('verified');

Route::any('balanco/mensal', 'App\Http\Controllers\BalancoController@balancoMensal')->name('mensal')->middleware('verified');
Route::any('balanco/comparativo', 'App\Http\Controllers\BalancoController@balancoComparativo')->name('comparativo')->middleware('verified');
Route::any('balanco/anual', 'App\Http\Controllers\BalancoController@balancoAnual')->name('anual')->middleware('verified');

Route::any('balanco/detalhe', 'App\Http\Controllers\BalancoController@grafico')->name('balancoDetalhe')->middleware('verified');
Route::any('balanco/detalhe/comparativo', 'App\Http\Controllers\BalancoController@graficoComparativo')->name('balancoComparativo')->middleware('verified');

Route::get('/mensagem-teste', function() {
    return new MensagemTesteMail();
});
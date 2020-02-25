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

Route::get('inicio', 'InicioController@index');
Route::get('/', 'HomeController@index');
Auth::routes();

Route::post('validarlogin', 'Auth\LoginController@validarlogin')->name('validarlogin');
// Route::get('/auth/login', 'FormatoController@logininicio');

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('Cotecmar/mae-tipo-cer', 'MaeTipoCerController');
Route::resource('Cotecmar/mae-nivel-cer', 'MaeNivelCerController');
Route::resource('Cotecmar/mae-certificados', 'MaeCertificadosController');
Route::resource('Cotecmar/mae-ente-certificador', 'MaeEnteCertificadorController');
Route::resource('Cotecmar/cer-registros', 'CerRegistrosController');
Route::resource('Cotecmar/datos-personales', 'DatosPersonalesController');
Route::get('CerRegistros/listPdf', 'CerRegistrosController@exportPdf')->name('CerRegistro.pdf');
Route::get('CerRegistros/listExcel', 'CerRegistrosController@exportExcel')->name('CerRegistro.excel');
Route::post('CerRegistros/cargarMasiva', 'CerRegistrosController@importExcel')->name('CerRegistro.import.excel');

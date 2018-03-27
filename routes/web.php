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
use App\Mail\Feedback as FeedbackEmail;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {


Route::resource('eventos', 'EventosController');
Route::resource('transacciones', 'TransaccionesController');
Route::resource('resumenAlumnos', 'ResumenAlumnosController');
Route::resource('resumenEventos', 'ResumenEventosController');
//quedan por comprobar
Route::get('reporte', 'ResumenAlumnosController@excel')->name('ReporteAlumnos.excel');;
Route::resource('Administracion/Feedback', 'FeedbackController');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/registrar', 'TransaccionesController@registrarTransaccion');

Route:get('/feedback',  function () {
 Mail::to('rap@uneatlantico.es')->send(new FeedbackEmail);
 });

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
use App\Mail\Reporte as ReporteEmail;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {


Route::resource('eventos', 'EventosController');
Route::resource('transacciones', 'TransaccionesController');
Route::resource('resumenAlumnos', 'ResumenAlumnosController');
Route::resource('resumenEventos', 'ResumenEventosController');
Route::resource('dashboard', 'DashboardController');
Route::resource('dashboardTv', 'DashboardTvController');
//quedan por comprobar
Route::get('reporte', 'ResumenAlumnosController@excel')->name('ReporteAlumnos.excel');


//Rutas para Maria Carla Marti (PRUEBAS)
Route::resource('dashboardMarti', 'DashboardMartiController');

//Rutas para Sandra Sumalla (PRUEBAS)
Route::resource('dashboardSumalla', 'DashboardMartiController');



});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/registrar', 'TransaccionesController@registrarTransaccion');
Route::post('/feedback',  function () {

	 Mail::to('rap@uneatlantico.es')->send(new FeedbackEmail);
 });


Route::get('/import', 'ImportController@import');
Route::get('/graficas', 'HighchartController@highchart');

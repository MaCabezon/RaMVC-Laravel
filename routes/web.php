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




});

// Grupo de administradores
Route::group(['middleware' => 'admin'], function () {
  Route::resource('eventos', 'EventosController',['parameters' => [
      'admin' => Auth::user()->email
    ]]);
  Route::resource('transacciones', 'TransaccionesController',['parameters' => [
      'admin' => Auth::user()->email
    ]]);
  Route::resource('resumenAlumnos', 'ResumenAlumnosController',['parameters' => [
      'admin' => Auth::user()->email
    ]]);
  Route::resource('resumenEventos', 'ResumenEventosController',['parameters' => [
      'admin' => Auth::user()->email
    ]]);
  Route::resource('dashboard', 'DashboardController',['parameters' => [
      'admin' => Auth::user()->email
    ]]);


  Route::resource('dashboardTv', 'DashboardTvController');
  Route::get('reporte', 'ResumenAlumnosController@excel')->name('ReporteAlumnos.excel');
  Route::get('/import', 'ImportController@import');
});

// Grupo gestores
Route::group(['middleware' => 'member'], function () {
  Route::resource('dashboardTv', 'DashboardTvController');
  Route::get('reporte', 'ResumenAlumnosController@excel')->name('ReporteAlumnos.excel');
});

// Grupo de usuario
Route::group(['middleware' => 'user'], function () {
  Route::resource('resumenAlumnos', 'ResumenAlumnosController',['parameters' => [
      'user' => Auth::user()->email
    ]]);


  Route::resource('dashboardTv', 'DashboardTvController');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/registrar', 'TransaccionesController@registrarTransaccion');
Route::post('/feedback',  function () {

	 Mail::to('rap@uneatlantico.es')->send(new FeedbackEmail);
 });



Route::get('/graficas', 'HighchartController@highchart');
Route::resource('dashboard', 'DashboardController');

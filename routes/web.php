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
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth', 'admin'], function () {

  Route::resource('eventos', 'EventosController');
  Route::resource('resumenAlumnos', 'ResumenAlumnosController');
  Route::resource('resumenEventos', 'ResumenEventosController');
  Route::resource('dashboard', 'DashboardController');
  Route::resource('dashboardTv', 'DashboardTvController');
  Route::get('reporte', 'ResumenAlumnosController@excel')->name('ReporteAlumnos.excel');
  Route::get('reporteTable', 'ResumenAlumnosController@reporteTable');
  Route::get('/import', 'ImportController@import');

  
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/registrar', 'TransaccionesController@registrarTransaccion');
Route::post('/datosBitPints','ResumenAlumnosController@obtenerDatosBecarios');
Route::post('/justificar', 'ResumenAlumnosController@justificarHoras');
Route::post('/feedback',  function () {

	 Mail::to('rap@uneatlantico.es')->send(new FeedbackEmail);
 });




Route::get('/graficas', 'HighchartController@highchart');
<<<<<<< HEAD
Route::resource('dashboard', 'DashboardController');
Route::resource('dashboardTv', 'DashboardTvController');
=======
Route::resource('dashboardTv', 'DashboardTvController');

//Login Google
Route::get('/social/redirect/{provider}', 'Auth\SocialController@getSocialRedirect')->name('redirectSocialLite');
Route::get('/social/handle/{provider}', 'Auth\SocialController@getSocialHandle')->name('handleSocialLite');
Route::get('/login/{provider}/callback', 'Auth\SocialController@getSocialHandle')->name('home');
>>>>>>> a3518e1c44b7a46ea18cce6da6d87215f80936f5

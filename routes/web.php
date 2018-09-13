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
  Route::resource('/eventos', 'EventosController');
  Route::resource('/resumenAlumnos', 'ResumenAlumnosController');
  Route::resource('/resumenEventos', 'ResumenEventosController');
  Route::resource('/transacciones', 'TransaccionesController');
  Route::resource('/dashboard', 'DashboardController');
  Route::get('/reporte', 'ResumenAlumnosController@excel')->name('ReporteAlumnos.excel');
  //Route::get('/reportes', 'ResumenAlumnosController@reporteTable')->name('reportes.index');
  Route::get('/reporteTable', 'ResumenAlumnosController@reporteTable');
  Route::post('/reporteTable', 'ResumenAlumnosController@reporteTable')->name('reportes.index');
  Route::get('/import', 'ImportController@import');
  Route::resource('/users','UserController');
  Route::resource('/roles','RoleController');
  Route::resource('/permissions', 'PermissionController');
  Route::resource('valoracionBecarios', 'ValoracionBecariosController');
  Route::resource('/notificaciones', 'NotificacionController');
  Route::get('/notificaciones', 'NotificacionController@index');
  Route::get('/marcarLeidas', 'NotificacionController@marcarLeidas');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/registrar', 'TransaccionesController@registrarTransaccion');
Route::get('/datosBitPoints','ResumenAlumnosController@obtenerDatosBecarios');
Route::post('/justificar', 'ResumenAlumnosController@justificarHoras');
Route::post('/feedback',  function () {
	 Mail::to('rap@uneatlantico.es')->send(new FeedbackEmail);
 });

Route::get('/correo',  function () {

  Mail::to('abraham.fernandez@alumnos.uneatlantico.es')->send(new ReporteEmail);
});


Route::get('/graficas', 'HighchartController@highchart');
Route::resource('/dashboardTv', 'DashboardTvController');

//Login Google
Route::get('/social/redirect/{provider}', 'Auth\SocialController@getSocialRedirect')->name('redirectSocialLite');
Route::get('/social/handle/{provider}', 'Auth\SocialController@getSocialHandle')->name('handleSocialLite');
Route::get('/login/{provider}/callback', 'Auth\SocialController@getSocialHandle')->name('home');
Route::post('/mishoras', 'ResumenAlumnosController@obtenerHoras')->name('resumenAlumnos.obtenerHoras');

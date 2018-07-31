<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    /**
     * Muestra un listado de los registros.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // Seleccionamos la vista del Dashboard Web dependiendo del rol del usuario logueado
      if (\Auth::user()->hasRole('admin') || \Auth::user()->hasRole('member')) {
        $vista = DB::select('SELECT reportedatos.*, resumenalumnos.Estado FROM reportedatos INNER JOIN resumenalumnos ON reportedatos.Alumno = resumenalumnos.Alumno AND reportedatos.Evento = resumenalumnos.Evento AND reportedatos.Grupo = resumenalumnos.Grupo WHERE (reportedatos.Evento LIKE "Becas%" OR reportedatos.Evento LIKE "Intervencion Agil%") AND WEEK(resumenalumnos.fechaEvento) = WEEK(CURDATE()) ORDER BY Evento, Alumno ASC');
        return view('dashboard.index')->with('vista',$vista);
      }
    }

    /**
     * Muestra el formulario para la creación de un nuevo registro.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Almacena un nuevo registro creado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Muestra el registro deseado.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Muestra el formulario para poder editar un registro especifico.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Actualiza un registro específico de la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Elimina un registro específico de la base de datos.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}

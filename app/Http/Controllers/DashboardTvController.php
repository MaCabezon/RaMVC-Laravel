<?php

namespace App\Http\Controllers;


use App\Models\DashboardTv;

use Illuminate\Http\Request;
use DB;

class DashboardTvController extends Controller
{
    /**
     * Muestra un listado de los registros.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $vista = DB::select('SELECT reporte.*, resumenalumnos.Estado FROM reporte INNER JOIN resumenalumnos ON reporte.Alumno = resumenalumnos.Alumno AND reporte.Evento = resumenalumnos.Evento AND reporte.Grupo = resumenalumnos.Grupo WHERE WEEK(resumenalumnos.fechaEvento) = WEEK(CURDATE()) ORDER BY Evento, Alumno ASC');

        return view('dashboardTv.index')->with('vista',$vista);
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

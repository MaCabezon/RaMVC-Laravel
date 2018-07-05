<?php

namespace App\Http\Controllers;


use App\Models\DashboardTv;

use Illuminate\Http\Request;
use DB;

class DashboardTvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $vista = DB::select('SELECT reporte.*, resumenalumnos.Estado FROM reporte INNER JOIN resumenalumnos ON reporte.Alumno = resumenalumnos.Alumno AND reporte.Evento = resumenalumnos.Evento AND reporte.Grupo = resumenalumnos.Grupo WHERE WEEK(resumenalumnos.fechaEvento) = WEEK(CURDATE()) ORDER BY Evento, Alumno ASC');

        return view('dashboardTv.index')->with('vista',$vista);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$selSql = 'SELECT resumenalumnos.*, resumen_alumnos.horas FROM resumenalumnos INNER JOIN resumen_alumnos ON resumen_alumnos.idAlumno = resumenalumnos.Alumno AND resumen_alumnos.idEvento = resumenalumnos.Evento AND resumen_alumnos.fechaEvento = resumenalumnos.fechaEvento WHERE resumenalumnos.Evento LIKE "Becas%" OR resumenalumnos.Evento LIKE "Intervencion Agil%" ORDER BY Evento';
        $selSql = 'SELECT * FROM resumenalumnos INNER JOIN eventos ON resumenalumnos.Evento = eventos.id AND eventos.nombreProfesor='sandra.sumalla' ORDER BY Evento';
        $vista = DB::select($selSql);
        return view('dashboard.index')->with('vista',$vista);
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

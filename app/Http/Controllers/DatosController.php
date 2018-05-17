<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DatosController extends Controller
{
    /**
     * Obetencion de datos para bitpoints
     *
     * 
     * 
     */
    public function obtenerDatosBecarios()
    {
            
            $vista = DB::select('SELECT reporte.*, resumenalumnos.Estado FROM reporte INNER JOIN resumenalumnos ON reporte.Alumno = resumenalumnos.Alumno
                 AND reporte.Evento = resumenalumnos.Evento AND reporte.Grupo = resumenalumnos.Grupo WHERE (reporte.Evento LIKE "Becas%" OR reporte.Evento
                 LIKE "Intervencion Agil%") AND WEEK(resumenalumnos.fechaEvento) = WEEK(CURDATE()) ORDER BY Evento, Alumno ASC');
        header('Content-Type: application/json');
        return json_encode($vista);         
    }
}

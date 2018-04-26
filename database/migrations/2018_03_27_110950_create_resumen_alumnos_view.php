<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumenAlumnosView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

         DB::statement( "CREATE VIEW  resumenalumnos as select ra.idAlumno AS Alumno,ev.nombre AS Evento,ev.grupo AS Grupo,
						 (CASE WHEN ra.horas = -1.00 && ra.validado = '0' THEN 'activado/pendiente'
						 WHEN ra.horas > -1.00 && ra.validado = '0' THEN 'desactivado/pendiente' 
						 WHEN ra.horas = -1.00 && ra.validado = '1' THEN 'activado' 
						 WHEN ra.horas > -1.00 && ra.validado = '1' THEN 'desactivado' END) AS Estado, 
						 ra.fechaEvento AS fechaEvento,ra.validado AS Validado
						 from (rapframework.resumen_alumnos ra join rapframework.eventos ev 
						 on((ra.idEvento = ev.id))) where ra.id in (select max(r.id)
						 from rapframework.resumen_alumnos r where (r.idAlumno = ra.idAlumno)) 
						 group by ra.idAlumno,ra.idEvento,ra.fechaEvento");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement( 'DROP VIEW resumenalumnos' );

    }
}

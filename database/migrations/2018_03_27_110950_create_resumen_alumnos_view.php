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

         DB::statement( "CREATE VIEW  resumenalumnos as SELECT ra.idAlumno AS Alumno,ev.nombre AS Evento,ev.grupo	AS Grupo,    sum((case when (ra.horas = -(1.00))
                  then 0 else ra.horas end))	AS Horas,if((ra.horas = -(1.00)), 'activado','desactivado')	AS Estado,ra.fechaEvento AS fechaEvento FROM resumen_alumnos AS ra
              JOIN eventos AS ev ON ra.idEvento = ev.id WHERE ra.id IN ( SELECT mAX(ra.id) )
              GROUP BY ra.idAlumno,ra.idEvento,ra.fechaEvento");

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

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
<<<<<<< HEAD
         DB::statement( 'CREATE VIEW  resumenalumnos as select [select resumen_alumnos.idAlumno AS Alumno,eventos.nombre AS Evento,eventos.grupo AS Grupo,sum((case when (resumen_alumnos.horas = -(1.00)) then 0 else resumen_alumnos.horas end)) AS Horas,if((resumen_alumnos.horas = -(1.00)),"activado","desactivado") AS Estado,resumen_alumnos.fechaEvento AS fechaEvento 
                from (resumen_alumnos join eventos on((resumen_alumnos.idEvento = eventos.id))) 
                group by resumen_alumnos.idAlumno,resumen_alumnos.idEvento'] );
         
=======
         DB::statement( 'CREATE VIEW  resumenalumnos as SELECT
           ra.idAlumno AS Alumno,
           ev.nombre AS Evento,
           ev.grupo	AS Grupo,
           sum((case when (ra.horas = -(1.00))
                  then 0 else ra.horas end))	AS Horas,
           if((ra.horas = -(1.00)), 'activado','desactivado')	AS Estado,
           ra.fechaEvento AS fechaEvento
            FROM resumen_alumnos AS ra
              JOIN eventos AS ev ON ra.idEvento = ev.id
              WHERE ra.id IN ( SELECT mAX(ra.id) )
              GROUP BY ra.idAlumno,ra.idEvento,ra.fechaEvento');
>>>>>>> c95b04b76aa60e6e232ce780e43afeb15d7c08c6
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

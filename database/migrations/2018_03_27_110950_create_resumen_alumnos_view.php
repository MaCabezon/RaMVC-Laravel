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
         DB::statement( 'CREATE VIEW  resumenalumnos as select [select resumen_alumnos.idAlumno AS Alumno,eventos.nombre AS Evento,sum((case when (resumen_alumnos.horas = -(1.00)) then 0 else resumen_alumnos.horas end)) AS Horas,if((resumen_alumnos.horas = -(1.00)),"activado","desactivado") AS Estado,resumen_alumnos.fechaEvento AS fechaEvento
                from (resumen_alumnos join eventos on((resumen_alumnos.idEvento = eventos.id)))
                group by resumen_alumnos.fechaEvento'] );
                DB::statement('CREATE VIEW resumenalumnos as select [SELECT
                  h.id,
                  ra.idAlumno AS Alumno,
                  ev.nombre 	AS Evento,
                  ev.grupo	AS Grupo,
                  sum((case when (ra.horas = -(1.00))
	                 then 0 else ra.horas end)
                 )			AS Horas,
                 if((h.horas = -(1.00)), 'activado','desactivado')	AS Estado,
                 h.fechaEvento 	AS fechaEvento
                 FROM resumen_alumnos AS ra
                 JOIN eventos AS ev on ra.idEvento = ev.id
                 JOIN ( SELECT * FROM `resumen_alumnos`
		                 where id IN( SELECT mAX(id)
		                   from resumen_alumnos GROUP BY idAlumno) ) AS h
		                     on ra.idAlumno = h.idAlumno
                         group by ra.idAlumno,ra.idEvento desc']);
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

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
         DB::statement( 'CREATE VIEW  resumenalumnos as select [select resumen_alumnos.idAlumno AS Alumno,eventos.nombre AS Evento,eventos.grupo AS Grupo,sum((case when (resumen_alumnos.horas = -(1.00)) then 0 else resumen_alumnos.horas end)) AS Horas,if((resumen_alumnos.horas = -(1.00)),"activado","desactivado") AS Estado,resumen_alumnos.fechaEvento AS fechaEvento 
                from (resumen_alumnos join eventos on((resumen_alumnos.idEvento = eventos.id))) 
                group by resumen_alumnos.idAlumno,resumen_alumnos.idEvento'] );
         
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


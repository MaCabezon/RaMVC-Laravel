<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReporteDatosView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::statement("CREATE VIEW  reportedatos as SELECT ra.idAlumno AS Alumno,ev.nombre AS Evento,ev.grupo AS Grupo,ev.nombreProfesor as Profesor,sum(ra.horas)AS Horas, 
       ra.fechaEvento AS fechaEvento FROM resumen_alumnos AS ra JOIN eventos AS ev 
       ON ra.idEvento = ev.id where ra.horas>'-1.00' and week(curdate())=week(ra.fechaEvento) 
       GROUP BY ra.idAlumno,ra.idEvento ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       DB::statement( 'DROP VIEW reportedatos' );
    }
}

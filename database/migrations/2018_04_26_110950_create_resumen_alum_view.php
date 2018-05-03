<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumenAlumView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::statement("CREATE VIEW  resumenalum as SELECT ra.id,ra.idAlumno,ra.idEvento,ev.nombre,ra.fechaEvento,ra.horas, 
                    if(ra.validado=1,'Validado','No validado') as validado,ra.created_at,ra.updated_at,ra.deleted_at 
                    FROM resumen_alumnos AS ra JOIN eventos AS ev ON ra.idEvento = ev.id ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       DB::statement( 'DROP VIEW resumenalum' );
    }
}

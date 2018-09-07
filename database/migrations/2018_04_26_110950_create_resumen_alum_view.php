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
                     (CASE WHEN ra.validado  = '1' THEN 'validado'
						 WHEN ra.validado = '0' THEN 'No validado'
						 WHEN ra.validado = '2' THEN 'Justificado'END) AS validado, ra.justificante                   
                    ra.created_at,ra.updated_at,ra.deleted_at,ev.nombreProfesor 
                    FROM resumen_alumnos AS ra JOIN eventos AS ev ON ra.idEvento = ev.id ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       DB::statement('DROP VIEW resumenalum' );
    }
}

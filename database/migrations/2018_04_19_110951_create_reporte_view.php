<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReporteView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::statement("CREATE VIEW  reporte as SELECT  r.Alumno,r.Evento,r.Horas,rd.HorasDia as HorasDia from 
       reporte r inner join reportediario rd on r.Alumno=rd.Alumno and r.Evento=rd.Evento 
       where rd.fechaEvento=curdate()");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       DB::statement( 'DROP VIEW reporte' );
    }
}

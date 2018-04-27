<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumenEventosView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::statement("CREATE VIEW  resumeneventos as SELECT re.*,ev.nombre FROM resumen_eventos AS re JOIN eventos AS ev 
                             ON re.idEvento = ev.id ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       DB::statement( 'DROP VIEW resumeneventos' );
    }
}

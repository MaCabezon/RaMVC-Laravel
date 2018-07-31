<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateValoracionBecariosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valoracion_becarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('idAlumno');
            $table->string('curso');
            $table->integer('formaTrabajo');
            $table->integer('actitud');
            $table->integer('manejoTecnologia');
            $table->integer('adaptacion');
            $table->integer('responsabilidad');
            $table->string('cumplimientoHoras');
            $table->string('materias');
            $table->string('annio');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('valoracion_becarios');
    }
}

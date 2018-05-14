<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResumenAlumnosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumen_alumnos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('idAlumno');
            $table->integer('idEvento')->unsigned();
            $table->foreign('idEvento')->references('id')->on('eventos');
            $table->date('fechaEvento');
            $table->decimal('horas');            
            $table->boolean('validado');
            $table->boolean('justificado');
            $table->string('justificante');
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
        Schema::drop('resumen_alumnos');
    }
}

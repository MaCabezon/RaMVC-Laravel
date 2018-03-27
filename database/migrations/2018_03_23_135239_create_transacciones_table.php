<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransaccionesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('idPersona');
            $table->integer('idEvento')->unsigned();
            $table->foreign('idEvento')->references('id')->on('eventos');
            $table->datetime('fechaEvento');
            $table->timestamp('fechaRegistro');
            $table->enum('tipo',array('Alumno', 'Porfesor'));         
            $table->boolean('validado');
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
        Schema::drop('transacciones');
    }
}

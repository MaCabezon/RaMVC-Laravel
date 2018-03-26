<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResumenEventosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumen_eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idEvento')->unsigned();
            $table->foreign('idEvento')->references('id')->on('eventos');
            $table->date('fechaEvento');
            $table->decimal('horas');
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
        Schema::drop('resumen_eventos');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaccionesView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::statement("CREATE alter VIEW  transaccionesView as SELECT t.id,t.idPersona,idEvento,ev.nombre,t.fechaEvento,t.tipo,if(t.validado=1,'Validado','No validado') as validado,
                        t.created_at,t.updated_at,t.deleted_at  FROM transacciones AS t JOIN eventos AS ev  ON t.idEvento = ev.id ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       DB::statement( 'DROP VIEW transaccionesView' );
    }
}

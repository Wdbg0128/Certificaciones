<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDatosPersonalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_personales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Num_Sap');
            $table->string('Identificacion');
            $table->string('Apellidos_Nombres');
            $table->string('Gerencia');
            $table->string('Planta');
            $table->string('Cargo');
            $table->date('fecha_inicio')->nullable();
            $table->date('Fin_Contrato')->nullable();
            $table->timestamps();
        // llaves
        $table->unique('Num_sap');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('datos_personales');
    }
}

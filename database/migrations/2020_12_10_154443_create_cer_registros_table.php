<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCerRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cer_registros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Num_Sap');
            $table->integer('tipo_id');
            $table->integer('maecertificado_id');
            $table->integer('nivel_id');
            $table->date('fecha_Expedicion')->nullable();
            $table->date('fecha_Fin')->nullable();
            $table->integer('maeentecertificador_id')->nullable();
            $table->string('archivo')->nullable();
            $table->boolean('concepto_aptitud')->default(false);
            $table->date('fecha_exp_concepto')->nullable();
            $table->date('fecha_fin_concepto')->nullable();
            $table->string('archivo_concepto')->nullable();
            $table->text('observacion')->nullable();
            $table->boolean('estado')->default(true);
            $table->boolean('revision')->default(false);
            $table->timestamps();
            // LLaves foraeas
            $table->unique(array('Num_Sap','maecertificado_id'));
            $table->foreign('maecertificado_id')->references('id')->on('mae_certificados');
            $table->foreign('maeentecertificador_id')->references('id')->on('mae_ente_certificadors');
            $table->foreign('nivel_id')->references('id')->on('mae_nivel_cer');
            $table->foreign('tipo_id')->references('id')->on('mae_tipo_cer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cer_registros');
    }
}

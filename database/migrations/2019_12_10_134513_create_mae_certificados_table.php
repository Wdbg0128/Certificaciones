<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMaeCertificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mae_certificados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Nombre_Certificado');
            $table->integer('Vigencia')->nullable();
            $table->boolean('concepto_aptitud');
            $table->boolean('Estado')->default(true);
            $table->timestamps();
    // llaves
            $table->unique('Nombre_Certificado');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mae_certificados');
    }
}

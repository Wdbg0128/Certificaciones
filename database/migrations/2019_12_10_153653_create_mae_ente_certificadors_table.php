<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMaeEnteCertificadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mae_ente_certificadors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Nombre_EnteCertificador');
            $table->boolean('Estado')->default(true);
            $table->timestamps();
            // llaves
            $table->unique('Nombre_EnteCertificador');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mae_ente_certificadors');
    }
}

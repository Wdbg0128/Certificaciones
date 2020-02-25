<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaeTipoCersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mae_tipo_cer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_tipo_cer');
            $table->timestamps();

            // llaves
            $table->unique('nombre_tipo_cer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mae_tipo_cer');
    }
}

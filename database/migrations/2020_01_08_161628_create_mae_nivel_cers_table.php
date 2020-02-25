<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaeNivelCersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mae_nivel_cer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_nivel_cer');
            $table->timestamps();
            // llaves
            $table->unique('nombre_nivel_cer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mae_nivel_cer');
    }
}

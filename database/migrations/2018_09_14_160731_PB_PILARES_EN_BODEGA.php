<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PBPILARESENBODEGA extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('PB_PILARES_EN_BODEGA', function (Blueprint $table) {
          $table->increments('PB_COD');
          $table->string('PB_UDI_COMPLETO', 45);
          $table->string('PB_LOTE' 45);
          $table->integer('PB_CANT', 16);
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('PB_PILARES_EN_BODEGA');
    }
}

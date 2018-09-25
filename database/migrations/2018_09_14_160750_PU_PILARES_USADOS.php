<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PUPILARESUSADOS extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('PU_PILARES_USADOS', function (Blueprint $table) {
          $table->increments('PU_COD');
          $table->date('PU_FECHA_USO');

          $table->integer('PU_PD_COD')->unsigned();
          $table->foreign('PU_PD_COD')->references('PD_COD')->on('PD_PIEZAS_DENTALES');

          $table->integer('PU_CIR_COD')->unsigned();
          $table->foreign('PU_CIR_COD')->references('CIR_COD')->on('CIR_CIRUGIA');

          $table->integer('PU_PB_COD')->unsigned();
          $table->foreign('PU_PB_COD')->references('PB_COD')->on('PB_PILARES_EN_BODEGA');



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
        Schema::dropIfExists('PU_PILARES_USADOS');
    }
}

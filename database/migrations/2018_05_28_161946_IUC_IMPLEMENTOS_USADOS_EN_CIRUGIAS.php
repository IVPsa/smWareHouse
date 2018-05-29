<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IUCIMPLEMENTOSUSADOSENCIRUGIAS extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS', function (Blueprint $table) {
            $table->increments('UIC_COD');

            //fk


            $table->integer('UIC_PD_COD')->unsigned();
            $table->foreign('UIC_PD_COD')->references('PD_COD')->on('PD_PIEZAS_DENTALES');

            $table->integer('IUC_CIR_COD')->unsigned();
            $table->foreign('IUC_CIR_COD')->references('CIR_COD')->on('CIR_CIRUGIA');

            $table->integer('IUC_ART_COD')->unsigned();
            $table->foreign('IUC_ART_COD')->references('ART_COD')->on('ART_ARTICULOS');

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
        Schema::dropIfExists('IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PLPILARES extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
          Schema::create('PL_PILARES', function (Blueprint $table) {
            $table->increments('PL_COD');
            $table->string('PL_NOMBRE', 45);
            $table->string('PL_DESCRIPCION', 45);
            $table->string('PL_N_ARTICULO',10);
            $table->string('PL_UDI01', 16);
            $table->integer('PL_TP_COD')->unsigned();
            $table->foreign('PL_TP_COD')->references('TP_COD')->on('TP_TIPO_PILAR');
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
        Schema::dropIfExists('PL_PILARES');
    }
}

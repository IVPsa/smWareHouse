<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ARTARTICULOS   extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ART_ARTICULOS', function (Blueprint $table) {
            $table->increments('ART_COD');
            $table->string('ART_UDI',45);
            $table->date('ART_FECHA_EXP');
            $table->string('ART_LOTE',10);
            $table->integer('ART_CANT');

            //FK
            $table->integer('ART_PROD_COD')->unsigned();
            $table->foreign('ART_PROD_COD')->references('PROD_COD')->on('PRO_PRODUCTOS');

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
        Schema::dropIfExists('ART_ARTICULOS');
    }
}

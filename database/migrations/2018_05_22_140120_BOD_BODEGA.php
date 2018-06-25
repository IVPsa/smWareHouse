<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BODBODEGA extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('BOD_BODEGA', function (Blueprint $table) {
            $table->increments('BOD_COD');

            //FK
            $table->integer('BOD_ART_COD')->unsigned();
            $table->foreign('BOD_ART_COD')->references('ART_COD')->on('ART_ARTICULOS');

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
        Schema::dropIfExists('BOD_BODEGA');
    }
}

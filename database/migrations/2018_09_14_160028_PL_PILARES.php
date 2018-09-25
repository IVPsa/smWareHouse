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
            $table->string('PL_DESCRIPCION');
            $table->string('PL_UDI01', 16);
            $table->date('PL_NOMBRE');
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

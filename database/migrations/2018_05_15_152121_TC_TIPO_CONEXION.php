<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TCTIPOCONEXION extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('TC_TIPO_CONEXION', function (Blueprint $table) {
          $table->increments('TC_COD');
          $table->string('TC_DES', 45);
          $table->string('TC_DIAMETRO',45);
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
        Schema::dropIfExists('TC_TIPO_CONEXION');
    }
}

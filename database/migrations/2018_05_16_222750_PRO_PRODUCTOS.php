<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PROPRODUCTOS extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('PRO_PRODUCTOS', function (Blueprint $table) {
          $table->increments('PROD_COD');
          $table->string('PROD_NOMBRE', 45);
          $table->text('PROD_DESCRIPCION');
          $table->text('PROD_N_ARTICULO');
          $table->string('PROD_DIAMETRO', 10);
          $table->string('PROD_LONGITUD', 10);
          $table->string('PROD_UDI_01', 16);

          //FK
          $table->integer('PROD_USU_COD')->unsigned();
          $table->foreign('PROD_USU_COD')->references('id')->on('users');

          $table->integer('PROD_CLC_COD')->unsigned();
          $table->foreign('PROD_CLC_COD')->references('CLC_COD')->on('CLC_COLOR_CODING');

          $table->integer('PROD_TC_COD')->unsigned();
          $table->foreign('PROD_TC_COD')->references('TC_COD')->on('TC_TIPO_CONEXION');

          $table->integer('PROD_TI_COD')->unsigned();
          $table->foreign('PROD_TI_COD')->references('TI_COD')->on('TI_TIPO_IMPLANTE');

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
        Schema::dropIfExists('PRO_PRODUCTOS');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CIRCIRUGIA extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('CIR_CIRUGIA', function (Blueprint $table) {
          $table->increments('CIR_COD');
          $table->string('CIR_NOMBRE_PACIENTE', 45);
          $table->string('CIR_RUT_PACIENTE', 45);
          $table->date('CIR_FECHA');
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
        Schema::dropIfExists('CIR_CIRUGIA');
    }
}

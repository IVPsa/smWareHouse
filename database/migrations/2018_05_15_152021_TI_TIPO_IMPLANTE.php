<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TITIPOIMPLANTE extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('TI_TIPO_IMPLANTE', function (Blueprint $table) {
            $table->increments('TI_COD');
            $table->string('TI_DES', 45);
            $table->string('TI_CLASE', 45);
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
        Schema::dropIfExists('TI_TIPO_IMPLANTE');
    }
}

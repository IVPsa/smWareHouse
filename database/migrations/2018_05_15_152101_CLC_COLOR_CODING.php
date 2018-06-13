<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CLCCOLORCODING extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('CLC_COLOR_CODING', function (Blueprint $table) {
          $table->increments('CLC_COD');
          $table->string('CLC_COLOR', 45);
          $table->text('CLC_DESC');
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
        Schema::dropIfExists('CLC_COLOR_CODING');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesoTitulacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('proceso_titulacion', function (Blueprint $table) {
          $table->increments('id');
          $table->bigInteger('id_opcion')->unsigned();
          $table->foreign('id_opcion')->references('id')->on('opciones_titulacion');
          $table->string('descripcion',255);
          $table->integer('orden');
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
        Schema::dropIfExists('proceso_titulacion');
    }
}

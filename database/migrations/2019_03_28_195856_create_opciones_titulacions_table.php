<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpcionesTitulacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opciones_titulacion', function (Blueprint $table) {
          $table->increments('id');
          $table->string('opcion_titulacion');
          $table->string('nombre_opcion');
          $table->string('detalle_opcion');
          $table->string('plan_de_estudios');
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
        Schema::dropIfExists('opciones_titulacion');
    }
}

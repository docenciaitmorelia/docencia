<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTitulacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('titulaciones', function (Blueprint $table) {
          $table->increments('id');
          $table->string('alumno');
          $table->foreign('alumno')->references('no_de_control')->on('alumnos');
          $table->integer('opc_titu');
          $table->string('asesor');
          $table->foreign('asesor')->references('rfc')->on('personal');
          $table->string('presidente');
          $table->foreign('presidente')->references('rfc')->on('personal');
          $table->string('secretario');
          $table->foreign('secretario')->references('rfc')->on('personal');
          $table->string('vocal_propietario');
          $table->foreign('vocal_propietario')->references('rfc')->on('personal');
          $table->string('vocal_suplente');
          $table->foreign('vocal_suplente')->references('rfc')->on('personal');
          $table->string('asesor_externo')->nullable();
          $table->string('nombre_proyecto')->nullable();
          $table->string('estatus');
          $table->string('fecha_cer')->nullable();
          $table->string('lugar')->nullable();
          $table->string('hora')->nullable();
          $table->string('proceso')->nullable();
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
        Schema::dropIfExists('titulaciones');
    }
}

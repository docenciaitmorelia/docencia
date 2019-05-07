<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMateriasCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias_carreras', function (Blueprint $table) {
          $table->string('carrera');
          $table->integer('reticula');
          $table->string('materia');
          $table->integer('creditos_materia');
          $table->integer('horas_teoricas');
          $table->integer('orden_certificado');
          $table->integer('semestre_reticula');
          $table->integer('creditos_prerrequisito');
          $table->string('especialidad');
          $table->string('clave_oficial_materia');
          $table->char('estatus_materia_carrera',1);
          $table->integer('renglon');
          $table->increments('id');
          $table->integer('id_materia');
          $table->foreign('id_materia')->references('id')->on('materias');
          $table->integer('id_carrera')->unsigned();
          $table->foreign('id_carrera')->references('id')->on('carreras');
          $table->primary(['id','materia']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materias_carreras');
    }
}

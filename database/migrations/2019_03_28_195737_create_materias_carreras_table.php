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
          $table->integer('horas_practicas');
          $table->integer('orden_certificado');
          $table->integer('semestre_reticula');
          $table->integer('creditos_prerrequisito');
          $table->string('especialidad');
          $table->string('clave_oficial_materia');
          $table->char('estatus_materia_carrera',1);
          $table->integer('renglon');
          $table->integer('id');
          $table->integer('id_materia');
          $table->integer('id_carrera');
          $table->string('id_especialidad');
          $table->primary('materia');
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

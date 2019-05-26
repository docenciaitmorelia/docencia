<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadesCompsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('actividades_comp', function (Blueprint $table) {
          $table->increments('id');
          $table->string('alumno');
          $table->foreign('alumno')->references('no_de_control')->on('alumnos');
          $table->string('actividad');
          $table->integer('tipo')->unsigned();
          $table->foreign('tipo')->references('id')->on('catalogo_ac');
          $table->integer('creditos');
          $table->string('fecha_del');
          $table->string('fecha_al');
          $table->string('horas')->nullable();
          $table->decimal('calificacion',5,2);
          $table->string('docente_resp')->nullable();
          $table->foreign('docente_resp')->references('rfc')->on('personal');
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
        Schema::dropIfExists('actividades_comp');
    }
}

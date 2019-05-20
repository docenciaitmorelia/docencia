<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupoCEstudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('grupo_cestudios', function (Blueprint $table) {
          $table->increments('id');
          $table->string('tutor');
          $table->foreign('tutor')->references('no_de_control')->on('alumnos');
          $table->string('materia');
          $table->foreign('materia')->references('materia')->on('materias_carreras');
          $table->string('ciclo_escolar');
          $table->string('dia1');
          $table->string('hora1');
          $table->string('salon1');
          $table->string('dia2');
          $table->string('hora2');
          $table->string('salon2');
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
        Schema::dropIfExists('grupo_cestudios');
    }
}

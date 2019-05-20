<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias', function (Blueprint $table) {
          $table->string('materia');
          $table->char('nivel_escolar',1);
          $table->integer('tipo_materia');
          $table->integer('clave_area');
          $table->string('nombre_completo_materia');
          $table->string('nombre_abreviado_materia');
          $table->integer('id');
          $table->string('tipo_calificacion');
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
        Schema::dropIfExists('materias');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carreras', function (Blueprint $table) {
          $table->integer('carrera');
          $table->biginteger('reticula')->unsigned;
          $table->char('nivel_escolar',1);
          $table->string('clave_oficial',20);
          $table->string('nombre_carrera',255);
          $table->string('nombre_reducido',255);
          $table->char('siglas',10);
          $table->integer('carga_maxima');
          $table->integer('carga_minima');
          $table->char('clave_cosnet',10);
          $table->integer('creditos_totales');
          $table->integer('fichas');
          $table->char('modalidad',1);
          $table->integer('id');
          $table->index('reticula');
          $table->primary('carrera');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carreras');
    }
}

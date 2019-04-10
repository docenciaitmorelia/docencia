<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('revisiones', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->integer('id_titulacion')->unsigned();
          $table->foreign('id_titulacion')->references('id')->on('titulaciones');
          $table->string('revisor',13);
          $table->foreign('revisor')->references('rfc')->on('personal');
          $table->string('tipo_revision',20);
          $table->date('fecha_revision');
          $table->string('veredicto',20);
          $table->string('comentarios');
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
        Schema::dropIfExists('revisiones');
    }
}

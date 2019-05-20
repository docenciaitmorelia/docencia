<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJevesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('jefes', function (Blueprint $table) {
          $table->string('clave_area');
          $table->string('descripcion_area');
          $table->string('jefe_area');
          $table->string('rfc');
          $table->foreign('rfc')->references('rfc')->on('personal');
          $table->string('dependencia_id');
          $table->primary('clave_area');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jefes');
    }
}

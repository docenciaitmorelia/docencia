<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('personal', function (Blueprint $table) {
          $table->string('rfc',13)->unique();
          $table->string('nombre_empleado');
          $table->string('apellidos_empleado');
          $table->string('especializacion');
          $table->string('correo_electronico')->unique();
          $table->char('sexo_empleado',1);
          $table->string('clave_area');
          $table->primary('rfc');
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
        Schema::dropIfExists('personal');
    }
}

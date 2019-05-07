<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganigramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organigrama', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clave_area');
            $table->string('descripcion_area');
            $table->biginteger('area_depende');
            $table->integer('nivel');
            $table->char('tipo_area',1);
            $table->string('subnivel');
            $table->primary(['id','clave_area']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organigrama');
    }
}

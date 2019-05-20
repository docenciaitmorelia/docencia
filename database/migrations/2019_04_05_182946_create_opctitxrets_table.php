<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpctitxretsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opctitxrets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_opcion_titulacion')->unsigned();
            $table->bigInteger('reticula');
            $table->foreign('id_opcion_titulacion')->references('id')->on('opciones_titulacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opctitxrets');
    }
}

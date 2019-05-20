<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('alumnos', function(Blueprint $table){
          $table->string('no_de_control',8)->unique();
          $table->integer('carrera')->unsigned();
          $table->biginteger('reticula');
          $table->string('especialidad');
          $table->char('nivel_escolar',1);
          $table->integer('semestre');
          $table->string('clave_interna');
          $table->string('estatus_alumno');
          $table->integer('plan_de_estudios');
          $table->string('apellido_paterno');
          $table->string('apellido_materno');
          $table->string('nombre_alumno');
          $table->string('curp_alumno');
          $table->date('fecha_nacimiento');
          $table->char('sexo',1);
          $table->char('estado_civil',1);
          $table->string('tipo_ingreso');
          $table->string('periodo_ingreso_it');
          $table->string('ultimo_periodo_inscrito');
          $table->string('promedio_periodo_anterior');
          $table->string('promedio_aritmetico_acumulado');
          $table->string('creditos_aprobados');
          $table->string('creditos_cursados');
          $table->string('promedio_final_alcanzado');
          $table->string('tipo_servicio_medico');
          $table->string('clave_servicio_medico');
          $table->string('escuela_procedencia');
          $table->string('tipo_escuela');
          $table->string('domicilio_escuela');
          $table->string('entidad_procedencia');
          $table->string('ciudad_procedencia');
          $table->string('correo_electronico')->nullable();
          $table->string('periodos_revalidacion');
          $table->string('becado_por');
          $table->string('nip');
          $table->char('nacionalidad',1);
          $table->string('usuario');
          $table->string('fecha_actualizacion');
          $table->string('folio');
          $table->string('periodo_estatus');
          $table->string('fecha_titulo');
          $table->string('op_titula');
          $table->string('cedula');
          $table->string('libro');
          $table->string('hoja');
          $table->string('ultimo_login');
          $table->string('id_sesion');
          $table->string('ip');
          $table->string('autoriza_padres');
          $table->string('creditos_cargados');
          $table->primary('no_de_control');

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
}

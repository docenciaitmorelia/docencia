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
          $table->string('clave_centro_seit');
          $table->string('clave_area');
          $table->string('curp_empleado');
          $table->string('no_tarjeta');
          $table->string('apellidos_empleado');
          $table->string('nombre_empleado');
          $table->string('horas_nombramiento');
          $table->char('nombramiento',1);
          $table->string('clases');
          $table->string('ingreso_rama');
          $table->string('inicio_gobierno');
          $table->string('inicio_sep');
          $table->string('inicio_plantel');
          $table->string('domicilio_empleado');
          $table->string('colonia_empleado');
          $table->string('codigo_postal_empleado');
          $table->string('localidad');
          $table->string('telefono_empleado');
          $table->char('sexo_empleado',1);
          $table->string('estado_civil');
          $table->date('fecha_nacimiento');
          $table->string('lugar_nacimiento');
          $table->string('institucion_egreso');
          $table->string('nivel_estudios');
          $table->string('grado_maximo_estudios');
          $table->string('estudios');
          $table->string('fecha_termino_estudios');
          $table->string('fecha_titulacion');
          $table->string('cedula_profesional');
          $table->string('especializacion');
          $table->string('idiomas_domina');
          $table->string('status_empleado');
          $table->string('foto');
          $table->string('firma');
          $table->string('correo_electronico');
          $table->string('padre');
          $table->string('madre');
          $table->string('conyuge');
          $table->string('hijos');
          $table->string('num_acta');
          $table->string('num_libro');
          $table->string('num_ano');
          $table->string('num_cartilla_smn');
          $table->string('ano_clase');
          $table->string('pigmentacion');
          $table->string('pelo');
          $table->string('frente');
          $table->string('cejas');
          $table->string('ojos');
          $table->string('nariz');
          $table->string('boca');
          $table->string('estaturamts');
          $table->string('pesokg');
          $table->string('senas_visibles');
          $table->string('pais');
          $table->string('pasaporte');
          $table->string('fm');
          $table->string('inicio_vigencia');
          $table->string('termino_vigencia');
          $table->string('entrada_salida');
          $table->string('observaciones_empleado');
          $table->string('area_academica',11);
          $table->string('tipo_personal');
          $table->string('tipo_control');
          $table->string('rfc2');
          $table->string('tipo_trabajador');
          $table->string('entidad_empleado');
          $table->primary('rfc');
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

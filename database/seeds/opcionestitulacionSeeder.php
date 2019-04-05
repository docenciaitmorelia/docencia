<?php

use Illuminate\Database\Seeder;

class opcionestitulacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('opciones_titulacion')->insert([
        'opcion_titulacion' => 'I',
        'nombre_opcion' => 'Tesis Profesional',
        'detalle_opcion' => 'Recepcional',
        'reticula' => '1993',
      ]);

      DB::table('opciones_titulacion')->insert([
        'opcion_titulacion' => 'II',
        'nombre_opcion' => 'Libros de texto o prototipos didácticos',
        'detalle_opcion' => 'Protocolario',
        'reticula' => '1993',
      ]);

      DB::table('opciones_titulacion')->insert([
        'opcion_titulacion' => 'III',
        'nombre_opcion' => 'Proyecto de Investigación',
        'detalle_opcion' => 'Recepcional',
        'reticula' => '1993',
      ]);

      DB::table('opciones_titulacion')->insert([
        'opcion_titulacion' => 'IV',
        'nombre_opcion' => 'Diseño o rediseño de equipo, aparato o maquinaria',
        'detalle_opcion' => 'Protocolario',
        'reticula' => '1993',
      ]);

      DB::table('opciones_titulacion')->insert([
        'opcion_titulacion' => 'V',
        'nombre_opcion' => 'Cursos especiales de titulación',
        'detalle_opcion' => 'Protocolario',
        'reticula' => '1993',
      ]);

      DB::table('opciones_titulacion')->insert([
        'opcion_titulacion' => 'VI',
        'nombre_opcion' => 'Examen global por áreas de conocimiento',
        'detalle_opcion' => 'Protocolario',
        'reticula' => '1993',
      ]);

      DB::table('opciones_titulacion')->insert([
        'opcion_titulacion' => 'VII',
        'nombre_opcion' => 'Memoria de experiencia profesional',
        'detalle_opcion' => 'Recepcional',
        'reticula' => '1993',
      ]);

      DB::table('opciones_titulacion')->insert([
        'opcion_titulacion' => 'VIII',
        'nombre_opcion' => 'Escolaridad por promedio',
        'detalle_opcion' => 'Protocolario',
        'reticula' => '1993',
      ]);

      DB::table('opciones_titulacion')->insert([
        'opcion_titulacion' => 'IX',
        'nombre_opcion' => 'Escolaridad por estudios de posgrado',
        'detalle_opcion' => 'Protocolario',
        'reticula' => '1993',
      ]);

      DB::table('opciones_titulacion')->insert([
        'opcion_titulacion' => 'X',
        'nombre_opcion' => 'Memoria de residencia profesional',
        'detalle_opcion' => 'Recepcional',
        'reticula' => '1993',
      ]);

      DB::table('opciones_titulacion')->insert([
        'opcion_titulacion' => 'I',
        'nombre_opcion' => 'Tesis profesional',
        'detalle_opcion' => 'Recepcional',
        'reticula' => '2004',
      ]);

      DB::table('opciones_titulacion')->insert([
        'opcion_titulacion' => 'III',
        'nombre_opcion' => 'Proyecto de Investigación',
        'detalle_opcion' => 'Recepcional',
        'reticula' => '2004',
      ]);

      DB::table('opciones_titulacion')->insert([
        'opcion_titulacion' => 'VI',
        'nombre_opcion' => 'Examen por áreas de conocimiento (CENEVAL)',
        'detalle_opcion' => 'Protocolario',
        'reticula' => '2004',
      ]);

      DB::table('opciones_titulacion')->insert([
        'opcion_titulacion' => 'VI',
        'nombre_opcion' => 'Examen por áreas de conocimiento',
        'detalle_opcion' => 'Protocolario',
        'reticula' => '2004',
      ]);

      DB::table('opciones_titulacion')->insert([
        'opcion_titulacion' => 'VIII',
        'nombre_opcion' => 'Escolaridad por promedio',
        'detalle_opcion' => 'Protocolario',
        'reticula' => '2004',
      ]);

      DB::table('opciones_titulacion')->insert([
        'opcion_titulacion' => 'X',
        'nombre_opcion' => 'Informe de Residencia Profesional',
        'detalle_opcion' => 'Recepcional',
        'reticula' => '2004',
      ]);

      DB::table('opciones_titulacion')->insert([
        'opcion_titulacion' => 'TI',
        'nombre_opcion' => 'Titulación Integral',
        'detalle_opcion' => 'Protocolario',
        'reticula' => '2004',
      ]);

      DB::table('opciones_titulacion')->insert([
        'opcion_titulacion' => '1',
        'nombre_opcion' => 'Titulación Integral por Tesis',
        'detalle_opcion' => 'Recepcional',
        'reticula' => '2010',
      ]);

      DB::table('opciones_titulacion')->insert([
        'opcion_titulacion' => '2',
        'nombre_opcion' => 'Titulación Integral por Proyecto de Investigación',
        'detalle_opcion' => 'Recepcional',
        'reticula' => '2010',
      ]);

      DB::table('opciones_titulacion')->insert([
        'opcion_titulacion' => '3',
        'nombre_opcion' => 'Titulación Integral por examen general para el egreso de la licenciatura (CENEVAL)',
        'detalle_opcion' => 'Protocolario',
        'reticula' => '2010',
      ]);

      DB::table('opciones_titulacion')->insert([
        'opcion_titulacion' => '4',
        'nombre_opcion' => 'Titulación Integral por Informe Técnico de Residencia Profesional',
        'detalle_opcion' => 'Recepcional',
        'reticula' => '2010',
      ]);
    }
}

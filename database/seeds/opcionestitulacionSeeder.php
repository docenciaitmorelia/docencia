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
        'id' => '1',
        'opcion_titulacion' => 'I',
        'nombre_opcion' => 'Tesis Profesional',
        'detalle_opcion' => 'Recepcional',
//        //'reticula' => '1993',
      ]);

      DB::table('opciones_titulacion')->insert([
        'id' => '2',
        'opcion_titulacion' => 'II',
        'nombre_opcion' => 'Libros de texto o prototipos didácticos',
        'detalle_opcion' => 'Protocolario',
        ////'reticula' => '1993',
      ]);

      DB::table('opciones_titulacion')->insert([
        'id' => '3',
        'opcion_titulacion' => 'III',
        'nombre_opcion' => 'Proyecto de Investigación',
        'detalle_opcion' => 'Recepcional',
        ////'reticula' => '1993',
      ]);

      DB::table('opciones_titulacion')->insert([
        'id' => '4',
        'opcion_titulacion' => 'IV',
        'nombre_opcion' => 'Diseño o rediseño de equipo, aparato o maquinaria',
        'detalle_opcion' => 'Protocolario',
        ////'reticula' => '1993',
      ]);

      DB::table('opciones_titulacion')->insert([
        'id' => '5',
        'opcion_titulacion' => 'V',
        'nombre_opcion' => 'Cursos especiales de titulación',
        'detalle_opcion' => 'Protocolario',
        ////'reticula' => '1993',
      ]);

      DB::table('opciones_titulacion')->insert([
        'id' => '6',
        'opcion_titulacion' => 'VI',
        'nombre_opcion' => 'Examen global por áreas de conocimiento (CENEVAL)',
        'detalle_opcion' => 'Protocolario',
        ////'reticula' => '1993',
      ]);

      DB::table('opciones_titulacion')->insert([
        'id' => '7',
        'opcion_titulacion' => 'VI',
        'nombre_opcion' => 'Examen global por áreas de conocimiento',
        'detalle_opcion' => 'Protocolario',
        ////'reticula' => '1993',
      ]);

      DB::table('opciones_titulacion')->insert([
        'id' => '8',
        'opcion_titulacion' => 'VII',
        'nombre_opcion' => 'Memoria de experiencia profesional',
        'detalle_opcion' => 'Recepcional',
        ////'reticula' => '1993',
      ]);

      DB::table('opciones_titulacion')->insert([
        'id' => '9',
        'opcion_titulacion' => 'VIII',
        'nombre_opcion' => 'Escolaridad por promedio',
        'detalle_opcion' => 'Protocolario',
        //'reticula' => '1993',
      ]);

      DB::table('opciones_titulacion')->insert([
        'id' => '10',
        'opcion_titulacion' => 'IX',
        'nombre_opcion' => 'Escolaridad por estudios de posgrado',
        'detalle_opcion' => 'Protocolario',
        //'reticula' => '1993',
      ]);

      DB::table('opciones_titulacion')->insert([
        'id' => '11',
        'opcion_titulacion' => 'X',
        'nombre_opcion' => 'Memoria de residencia profesional',
        'detalle_opcion' => 'Recepcional',
        //'reticula' => '1993',
      ]);

      DB::table('opciones_titulacion')->insert([
        'id' => '12',
        'opcion_titulacion' => 'I',
        'nombre_opcion' => 'Tesis profesional',
        'detalle_opcion' => 'Recepcional',
        //'reticula' => '2004',
      ]);

      DB::table('opciones_titulacion')->insert([
        'id' => '13',
        'opcion_titulacion' => 'III',
        'nombre_opcion' => 'Proyecto de Investigación',
        'detalle_opcion' => 'Recepcional',
        //'reticula' => '2004',
      ]);

      DB::table('opciones_titulacion')->insert([
        'id' => '14',
        'opcion_titulacion' => 'VI',
        'nombre_opcion' => 'Examen por áreas de conocimiento (CENEVAL)',
        'detalle_opcion' => 'Protocolario',
        //'reticula' => '2004',
      ]);

      DB::table('opciones_titulacion')->insert([
        'id' => '15',
        'opcion_titulacion' => 'VI',
        'nombre_opcion' => 'Examen por áreas de conocimiento',
        'detalle_opcion' => 'Protocolario',
        //'reticula' => '2004',
      ]);

      DB::table('opciones_titulacion')->insert([
        'id' => '16',
        'opcion_titulacion' => 'VIII',
        'nombre_opcion' => 'Escolaridad por promedio',
        'detalle_opcion' => 'Protocolario',
        //'reticula' => '2004',
      ]);

      DB::table('opciones_titulacion')->insert([
        'id' => '17',
        'opcion_titulacion' => 'X',
        'nombre_opcion' => 'Informe de Residencia Profesional',
        'detalle_opcion' => 'Recepcional',
        //'reticula' => '2004',
      ]);

      DB::table('opciones_titulacion')->insert([
        'id' => '18',
        'opcion_titulacion' => 'TI',
        'nombre_opcion' => 'Titulación Integral',
        'detalle_opcion' => 'Protocolario',
        //'reticula' => '2004',
      ]);

      DB::table('opciones_titulacion')->insert([
        'id' => '19',
        'opcion_titulacion' => '1',
        'nombre_opcion' => 'Titulación Integral por Tesis',
        'detalle_opcion' => 'Recepcional',
        //'reticula' => '2010',
      ]);

      DB::table('opciones_titulacion')->insert([
        'id' => '20',
        'opcion_titulacion' => '2',
        'nombre_opcion' => 'Titulación Integral por Proyecto de Investigación',
        'detalle_opcion' => 'Recepcional',
        //'reticula' => '2010',
      ]);

      DB::table('opciones_titulacion')->insert([
        'id' => '21',
        'opcion_titulacion' => '3',
        'nombre_opcion' => 'Titulación Integral por examen general para el egreso de la licenciatura (CENEVAL)',
        'detalle_opcion' => 'Protocolario',
        //'reticula' => '2010',
      ]);

      DB::table('opciones_titulacion')->insert([
        'id' => '22',
        'opcion_titulacion' => '4',
        'nombre_opcion' => 'Titulación Integral por Informe Técnico de Residencia Profesional',
        'detalle_opcion' => 'Recepcional',
        //'reticula' => '2010',
      ]);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Carrera;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class Alumno extends Model
{
    protected $table = 'alumnos';

    public function scopeAL($query,$busqueda)
    {
      /*
      select no_de_control,nombre_alumno,apellido_paterno,apellido_materno,carreras.nombre_reducido,carreras.reticula
      from alumnos
      join (select carrera,nombre_reducido,reticula from carreras where carrera = '106') as carreras
      on carreras.carrera = alumnos.carrera
      where carreras.reticula = alumnos.reticula and nombre_alumno like '%MA%';
      */
      $carreras = DB::table('carreras')
      ->select('carrera','nombre_reducido','reticula')
      ->where('carrera', '=', Auth::user()->carrera);
      $busqueda= mb_strtoupper($busqueda,'UTF-8');
      $query->select('no_de_control','nombre_alumno','apellido_paterno','apellido_materno','carreras.nombre_reducido','carreras.reticula')
        ->joinSub($carreras, 'carreras', function ($join) {
            $join->on('alumnos.carrera','=','carreras.carrera')
            ->where('carreras.reticula','=','alumnos.reticula');
        });
        return $query->select('*')
        ->where('no_de_control','LIKE',"'%$busqueda%'")
        ->orwhere(DB::raw("CONCAT(alumnos.nombre_alumno,' ',alumnos.apellido_paterno,' ',alumnos.apellido_materno)"), 'LIKE', "%$busqueda%");

      }
}

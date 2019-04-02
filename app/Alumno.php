<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Carrera;
use Illuminate\Support\Facades\DB;


class Alumno extends Model
{
    protected $table = 'alumnos';

    public function scopeAL($query,$busqueda)
    {
      $carreras = DB::table('carreras')
      ->select('carrera','nombre_reducido')
      ->distinct();
      $busqueda= mb_strtoupper($busqueda,'UTF-8');
      return $query->select('no_de_control','nombre_alumno','apellido_paterno','apellido_materno','carreras.nombre_reducido as carrera')
        ->joinSub($carreras, 'carreras', function ($join) {
            $join->on('alumnos.carrera','=','carreras.carrera');
        })
        ->where('no_de_control','LIKE',"'%$busqueda%'")
        ->orwhere(DB::raw("CONCAT(alumnos.nombre_alumno,' ',alumnos.apellido_paterno,' ',alumnos.apellido_materno)"), 'LIKE', "%$busqueda%");
    }
}

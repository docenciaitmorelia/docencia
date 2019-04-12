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
      $carreras = DB::table('carreras')
      ->select('carreras.carrera','nombre_reducido','reticula')
      ->join('permisos','permisos.carrera','=','carreras.carrera')
      ->where('permisos.clave_area','=',Auth::user()->clave_area);
      $busqueda= mb_strtoupper($busqueda,'UTF-8');
      return $query
        ->where(function($query) use($busqueda){
          $query->where('estatus_alumno','=','EGR')
            ->orWhere([['estatus_alumno','=','ACT'],['creditos_aprobados','>=',350],])
            ->where(DB::raw("CONCAT(alumnos.nombre_alumno,' ',alumnos.apellido_paterno,' ',alumnos.apellido_materno)"), 'LIKE', "'%$busqueda%'");

        })
        ->joinSub($carreras, 'carreras', function ($join) {
            $join->on([['alumnos.carrera','carreras.carrera'],['alumnos.reticula','carreras.reticula'],]);
        });
    }
}

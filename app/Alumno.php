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
      return $query->select('alumnos.reticula as alreticula','no_de_control','nombre_alumno','apellido_paterno','apellido_materno','carreras.nombre_reducido','carreras.reticula')

        ->joinSub($carreras, 'carreras', function ($join) {
            $join->on('alumnos.carrera','=','carreras.carrera')
            ->on('alumnos.reticula','=','carreras.reticula')
            ->where('estatus_alumno','EGR')
            ->orWhere([['estatus_alumno','ACT'],['creditos_aprobados','>=',350],]);
        })
        ->where('no_de_control','LIKE',"'%$busqueda%'")
        ->orwhere(DB::raw("CONCAT(alumnos.nombre_alumno,' ',alumnos.apellido_paterno,' ',alumnos.apellido_materno)"), 'LIKE', "%$busqueda%");
    }
}

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
      ->select('carrera','nombre_reducido','reticula')
      ->where('carrera', '=', 108)
      ->orwhere('carrera','=',109)
      ->orwhere('carrera','=',112)
      ->orwhere('carrera','=',111);
      /*$carreras = DB::table('carreras')
      ->select('carrera','nombre_reducido','reticula')
      ->where('carrera', '=', Auth::user()->carrera);*/
      $busqueda= mb_strtoupper($busqueda,'UTF-8');
      return $query->select('alumnos.reticula as alreticula','no_de_control','nombre_alumno','apellido_paterno','apellido_materno','carreras.nombre_reducido','carreras.reticula')
        ->joinSub($carreras, 'carreras', function ($join) {
            $join->on('alumnos.carrera','=','carreras.carrera')
            ->on('alumnos.reticula','=','carreras.reticula');
        })
        ->where('no_de_control','LIKE',"'%$busqueda%'")
        ->orwhere(DB::raw("CONCAT(alumnos.nombre_alumno,' ',alumnos.apellido_paterno,' ',alumnos.apellido_materno)"), 'LIKE', "%$busqueda%");
    }
}

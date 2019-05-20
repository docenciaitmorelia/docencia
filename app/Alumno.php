<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Carrera;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class Alumno extends Model
{
    protected $table = 'alumnos';

    public function scopeAl($query)
    {
      $clave_area_usuario = DB::table('personal')->where('rfc',Auth::user()->name)->first();
      $carreras = DB::table('carreras')
      ->select('carreras.carrera','nombre_reducido','reticula')
      ->join('permisos','permisos.carrera','=','carreras.carrera')
      ->where('permisos.clave_area',$clave_area_usuario->area_academica);
      return $query
        ->select('alumnos.*','carreras.nombre_reducido')
        ->where(function($query){
          $query->where('estatus_alumno','=','EGR')
            ->orWhere([['estatus_alumno','=','ACT'],['creditos_aprobados','>=',200],]);

        })
        ->joinSub($carreras, 'carreras', function ($join) {
            $join->on([['alumnos.carrera','carreras.carrera'],['alumnos.reticula','carreras.reticula'],]);
        });
    }
    public function scopeFiltrar($query,$busqueda){
      //$query = Alumno::Al();
      $busqueda= mb_strtoupper($busqueda,'UTF-8');
      return $query
      ->where(DB::raw("CONCAT(alumnos.nombre_alumno,' ',alumnos.apellido_paterno,' ',alumnos.apellido_materno)"), 'LIKE', "%$busqueda%")
      ->orWhere('no_de_control','like',"%$busqueda%");
    }

    public function scopeALAC($query)
    {
      $clave_area_usuario = DB::table('personal')->where('rfc',Auth::user()->name)->first();
      $carreras = DB::table('carreras')
      ->select('carreras.carrera','nombre_reducido','reticula')
      ->join('permisos','permisos.carrera','=','carreras.carrera')
      ->where('permisos.clave_area',$clave_area_usuario->area_academica);
      return $query
        ->select('alumnos.*','carreras.nombre_reducido')
        ->where(function($query){
          $query->where('estatus_alumno','=','ACT');

        })
        ->joinSub($carreras, 'carreras', function ($join) {
            $join->on([['alumnos.carrera','carreras.carrera'],['alumnos.reticula','carreras.reticula'],]);
        });
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Alumno;
use App\Titulacion;

class Titulacion extends Model
{
  protected $table = 'titulaciones';

  protected $fillable = [
      'alumno' , 'opc_titu' , 'asesor' , 'sinodal1', 'sinodal2' , 'sinodal3', 'Proyecto',
  ];

  protected $primaryKey = 'id';

  public function scopeBT($query,$s)
  {
    $s= mb_strtoupper($s,'UTF-8');
    return $query->join('alumnos','titulaciones.alumno','=','alumnos.no_de_control')
                  ->where('revisor1',Auth::user()->name)
                  ->where('estatus','ACTIVO')
                  ->orWhere('revisor2',Auth::user()->name)
                  ->orWhere('revisor3',Auth::user()->name)
                  ->where('titulaciones.alumno','LIKE',"%$s%");
                  //->orwhere(DB::raw("CONCAT(alumnos.nombre_alumno,' ',alumnos.apellido_paterno,' ',alumnos.apellido_materno)"), 'LIKE', "%$s%");
  }
  public function scopeBT2($query,$s)
  {
    $s= mb_strtoupper($s,'UTF-8');
    $alumnos = DB::table('alumnos')
    ->where('estatus_alumno','EGR')
    ->orWhere([['estatus_alumno','ACT'],['creditos_aprobados','>=',200],])
    ->groupBy('no_de_control');
    $clave_area_usuario = DB::table('personal')->select('area_academica')->where('rfc',Auth::user()->name)->first();
    return $query
          ->joinSub($alumnos,'alumnos',function ($join) {
            $join->on('titulaciones.alumno','=','alumnos.no_de_control');
          })
          ->join('permisos','permisos.carrera','=','alumnos.carrera')
          ->where('permisos.clave_area',$clave_area_usuario->area_academica)
          ->where('permisos.usuario',Auth::user()->name)
          ->where('titulaciones.alumno','LIKE',"%$s%")
          ->orwhere(DB::raw("CONCAT(alumnos.nombre_alumno,' ',alumnos.apellido_paterno,' ',alumnos.apellido_materno)"), 'LIKE', "%$s%")
          ->groupBy('titulaciones.id');
  }
}

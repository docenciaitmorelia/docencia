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
                  ->where('secretario',Auth::user()->name)
                  ->where('estatus','ACTIVO')
                  ->orWhere('presidente',Auth::user()->name)
                  ->orWhere('vocal_propietario',Auth::user()->name)
                  ->orWhere('vocal_suplente',Auth::user()->name)
                  ->where('titulaciones.alumno','LIKE',"%$s%");
                  //->orwhere(DB::raw("CONCAT(alumnos.nombre_alumno,' ',alumnos.apellido_paterno,' ',alumnos.apellido_materno)"), 'LIKE', "%$s%");
  }
  public function scopeBT2($query,$s)
  {
    $s= mb_strtoupper($s,'UTF-8');
    $alumnos = DB::table('alumnos')
    ->where('alumnos.estatus_alumno','=','ACT');
    return $query
          ->joinSub($alumnos,'alumnos',function ($join) {
            $join->on('titulaciones.alumno','=','alumnos.no_de_control');
          })
          ->join('permisos','permisos.carrera','=','alumnos.carrera')
          ->where('permisos.clave_area','=',Auth::user()->clave_area)
          ->where('titulaciones.alumno','LIKE',"%$s%")
          ->orwhere(DB::raw("CONCAT(alumnos.nombre_alumno,' ',alumnos.apellido_paterno,' ',alumnos.apellido_materno)"), 'LIKE', "%$s%");
  }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\DB;
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
                  ->where('titulaciones.alumno','LIKE',"%$s%")
                  ->orwhere(DB::raw("CONCAT(alumnos.nombre_alumno,' ',alumnos.apellido_paterno,' ',alumnos.apellido_materno)"), 'LIKE', "%$s%");
  }

}

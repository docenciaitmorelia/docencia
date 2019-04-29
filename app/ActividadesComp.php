<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Alumno;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ActividadesComp extends Model
{
  protected $table = 'actividades_comp';

  public function scopeAC($query,$s)
  {
    return $query->join('alumnos as a','actividades_comp.alumno','=','a.no_de_control')
                  ->where('actividades_comp.alumno','LIKE',"%$s%")
                  ->orwhere(DB::raw("CONCAT(a.nombre_alumno,' ',a.apellido_paterno,' ',a.apellido_materno)"), 'LIKE', "%$s%")
                  ->orwhere(DB::raw("CONCAT(a.apellido_paterno,' ',a.apellido_materno,' ',a.nombre_alumno)"), 'LIKE', "%$s%");
  }
}

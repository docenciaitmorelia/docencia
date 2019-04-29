<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Materia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GrupoCEstudio extends Model
{
  protected $table = 'grupo_cestudios';
  protected $fillable = [
      'alumno' ,
  ];

  protected $primaryKey = 'id';

  public function scopeBG($query,$s)
  {
      $s= mb_strtoupper($s,'UTF-8');
    return $query->select('grupo_cestudios.id','grupo_cestudios.tutor','materias.nombre_completo_materia','grupo_cestudios.ciclo_escolar')
                ->join('alumnos','grupo_cestudios.tutor','=','alumnos.no_de_control')
                ->join('materias','grupo_cestudios.materia', '=','materias.id')
                ->where('grupo_cestudios.tutor','LIKE',"%$s%")
                ->orwhere(DB::raw("CONCAT(alumnos.nombre_alumno,' ',alumnos.apellido_paterno,' ',alumnos.apellido_materno)"), 'LIKE', "%$s%");
  }
}

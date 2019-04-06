<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpcionesTitulacion extends Model
{
    protected $table = 'opciones_titulacion';
    protected $primaryKey = 'id';
    public function scopePT($query,$s)
    {
      return $query->select('opciones_titulacion.*')
      ->where('opciones_titulacion.id','LIKE',"%$s%")
      ->orwhere('nombre_opcion','LIKE',"%$s%");
    }

    //SCOPE Opcion de Titulación
    public function scopeOT($query,$alumnos)
    {
      $reticulas = Array();
      foreach($alumnos as $alumno){
        array_push($reticulas,$alumno->reticula);
      }
      $reticulas=array_unique($reticulas);
      return $query->select('*')
                    ->whereIn('reticula',$reticulas);
    }
}

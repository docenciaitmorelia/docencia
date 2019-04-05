<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcesoTitulacion extends Model
{
  protected $table = 'proceso_titulacion';

  protected $primaryKey = 'id';

  public function scopePT($query,$s)
  {
    return $query->select('o.reticula','proceso_titulacion.id as id','o.nombre_opcion','orden','descripcion')
    ->join('opciones_titulacion as o','o.id','=','proceso_titulacion.id_opcion')
    ->where('o.nombre_opcion','LIKE',"%$s%")
    ->orwhere('proceso_titulacion.descripcion','LIKE',"%$s%");
  }
}

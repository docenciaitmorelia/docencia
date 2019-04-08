<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\opctitxret;

class ProcesoTitulacion extends Model
{
  protected $table = 'proceso_titulacion';

  protected $primaryKey = 'id';

  public function scopePT($query,$s)
  {
    return $query->select('proceso_titulacion.id as id','o.nombre_opcion','orden','descripcion')
    ->join('opciones_titulacion as o','o.id','=','proceso_titulacion.id_opcion')
    ->join('opctitxrets as r','r.id_opcion_titulacion','=','o.id')
    ->where('o.nombre_opcion','LIKE',"%$s%")
    ->orwhere('proceso_titulacion.descripcion','LIKE',"%$s%");
  }
}
